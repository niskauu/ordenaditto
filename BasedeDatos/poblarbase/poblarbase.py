# https://api.pokemontcg.io/v2/cards?q=set.id:swsh4&select=id,name,set,rarity,regulationMark,artist,image,tcgplayer


from types import NoneType
from pokemontcgsdk import RestClient
from pokemontcgsdk import Card, Set
import psycopg2

conn = psycopg2.connect(database = "ordenaditto", 
                        user = "", 
                        host= 'localhost',
                        password = "",
                        port = 5432)

cur = conn.cursor()

RestClient.configure('')

cards = Card.where(q='set.id:sv2')
collection = Set.find('sv2')
cur.callproc('insertar_coleccion', [str(collection.series).lower(),'pgscript'])

for card in cards:
    printing = card.tcgplayer.prices.__dict__
    printing = {k: v for k, v in printing.items() if v is not None}
    printing = [key for key in printing.keys()]
    for impresion in printing:
        cur.callproc('insertar_carta', (card.id, str(card.name).lower(), str(card.set.series).lower(), card.set.name, card.rarity, card.regulationMark, card.artist, card.images.large, 'english', impresion, 'pgscript'))   
        conn.commit()
cur.close()
conn.close()
# https://api.pokemontcg.io/v2/cards?q=set.id:swsh4&select=id,name,set,rarity,regulationMark,artist,image,tcgplayer


from types import NoneType
from pokemontcgsdk import RestClient
from pokemontcgsdk import Card
import psycopg2

conn = psycopg2.connect(database = "ordenaditto", 
                        user = "", 
                        host= 'localhost',
                        password = "",
                        port = 5432)

cur = conn.cursor()

RestClient.configure('api-key')

cards = Card.where(q='set.id:swsh4')

for card in cards:
    printing = card.tcgplayer.prices.__dict__
    printing = {k: v for k, v in printing.items() if v is not None}
    printing = [key for key in printing.keys()]
    for impresion in printing:
        cur.callproc('insertar_carta', (card.id, card.name, card.set.series, card.set.name, card.rarity, card.regulationMark, card.artist, card.images.large, 'english', impresion))   
        conn.commit()
cur.close()
conn.close()

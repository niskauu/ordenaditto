# https://api.pokemontcg.io/v2/cards?q=set.id:swsh4&select=id,name,set,rarity,regulationMark,artist,image,tcgplayer


from types import NoneType
from pokemontcgsdk import RestClient
from pokemontcgsdk import Card, Set
import psycopg2
import uuid

conn = psycopg2.connect(database = "ordenaditto", 
                        user = "", 
                        host= 'localhost',
                        password = "",
                        port = 5432)

cur = conn.cursor()

RestClient.configure('')

cards = Card.where(q='set.id:sv3')
collection = Set.find('sv3')
# cur.callproc('insertar_serie', [str(collection.series).lower(),'pgscript'])
cur.callproc('insertar_set', [str(collection.name).lower(),str(collection.series).lower(),'pgscript'])

energy = 1

for card in cards:
    printing = card.tcgplayer.prices.__dict__
    printing = {k: v for k, v in printing.items() if v is not None}
    printing = [key for key in printing.keys()]
    for impresion in printing:
        cur.execute(f"select * from ilustrador i where i.nombre='{str(card.artist).lower()}'")
        if not(bool(cur.rowcount)):
            if card.artist is None:
                if energy == 0:
                    cur.callproc('insertar_ilustrador', ('energy', 'redsocial prueba','pgscript'))
                    energy += 1
            else:
                cur.callproc('insertar_ilustrador', (str(card.artist).lower(), 'redsocial prueba','pgscript'))
        cur.execute(f"select * from categoria c where c.nombre='{str(card.supertype).lower()}'")
        if not(bool(cur.rowcount)):
            cur.callproc('insertar_categoria', (str(card.supertype).lower(), 'pgscript'))
        if card.artist is None:
            cur.callproc('insertar_carta', (str(card.id), str(card.name).lower(), str(card.set.name).lower(), str(card.supertype).lower(), 'energy', str(card.rarity).lower(), str(card.regulationMark).lower(), card.images.large, 'english', str(impresion).lower(), 'pgscript'))   
        else:
            cur.callproc('insertar_carta', (str(card.id), str(card.name).lower(), str(card.set.name).lower(), str(card.supertype).lower(), str(card.artist).lower(), str(card.rarity).lower(), str(card.regulationMark).lower(), card.images.large, 'english', str(impresion).lower(), 'pgscript'))
        conn.commit()
cur.close()
conn.close()

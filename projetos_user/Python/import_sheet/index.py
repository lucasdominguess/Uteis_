import pandas as pd
import sqlalchemy as sql 
from sqlalchemy import create_engine , text 

cnes_unidades = pd.read_excel("final_cirurgias.xlsx",sheet_name="cnes_unidades")
cnes_cirurgias = pd.read_excel("final_cirurgias.xlsx",sheet_name="cnes_cirurgias")
cnes_partos = pd.read_excel("final_cirurgias.xlsx",sheet_name="cnes_partos")

# df_partos = pd.read_excel("cirurgias_edit.xlsx",sheet_name="partos")
# print(cnes_unidades)

sql = "postgresql+pg8000://postgres:123@localhost/planilha"
engine = create_engine(sql)

# print(engine)
with engine.connect() as conn :
    # df=pd.read_sql(text("select * from estagiarios"),conn)
    cnes_unidades.to_sql("unidades",if_exists="append",index=False,con=conn)
    cnes_partos.to_sql("partos",if_exists="append",index=False,con=conn)
    cnes_cirurgias.to_sql("cirurgias",if_exists="append",index=False,con=conn)
    conn.commit()

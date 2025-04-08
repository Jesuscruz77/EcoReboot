from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from typing import List, Optional
import databases
import sqlalchemy
from sqlalchemy import select
from datetime import datetime

# Configuración de la base de datos (según tu db.php)
DATABASE_URL = "mysql+asyncmy://root:@db/ecoreboot"  # ✔️ "db" es el nombre del servicio en docker-compose
database = databases.Database(DATABASE_URL)
metadata = sqlalchemy.MetaData()

# Definición de tablas
donaciones = sqlalchemy.Table(
    "donaciones",
    metadata,
    sqlalchemy.Column("id_donacion", sqlalchemy.Integer, primary_key=True),
    sqlalchemy.Column("id_usuario", sqlalchemy.Integer),
    sqlalchemy.Column("id_tipo_electrodomestico", sqlalchemy.Integer),
    sqlalchemy.Column("id_estado_dispositivo", sqlalchemy.Integer),
    sqlalchemy.Column("fecha", sqlalchemy.DateTime),
    sqlalchemy.Column("imperfecciones", sqlalchemy.String(255)),
    sqlalchemy.Column("telefono", sqlalchemy.String(20)),
    sqlalchemy.Column("total_dispositivos", sqlalchemy.Integer)
)

usuarios = sqlalchemy.Table(
    "usuarios",
    metadata,
    sqlalchemy.Column("id_usuario", sqlalchemy.Integer, primary_key=True),
    sqlalchemy.Column("nombre", sqlalchemy.String(100)),
    sqlalchemy.Column("telefono", sqlalchemy.String(20)),
    sqlalchemy.Column("correo", sqlalchemy.String(100)),
    sqlalchemy.Column("id_rol_usuario", sqlalchemy.Integer)
)

tipo_electrodomestico = sqlalchemy.Table(
    "tipo_electrodomestico",
    metadata,
    sqlalchemy.Column("id_tipo_electrodomestico", sqlalchemy.Integer, primary_key=True),
    sqlalchemy.Column("nombre", sqlalchemy.String(100))
)

estado_dispositivo = sqlalchemy.Table(
    "estado_dispositivo",
    metadata,
    sqlalchemy.Column("id_estado_dispositivo", sqlalchemy.Integer, primary_key=True),
    sqlalchemy.Column("nombre", sqlalchemy.String(100))
)

# Modelos Pydantic
class Usuario(BaseModel):
    id_usuario: int
    nombre: str
    telefono: str
    correo: str
    rol: Optional[dict] = None

class TipoElectrodomestico(BaseModel):
    id_tipo_electrodomestico: int
    nombre: str

class EstadoDispositivo(BaseModel):
    id_estado_dispositivo: int
    nombre: str

class Donacion(BaseModel):
    id_donacion: int
    id_usuario: int
    id_tipo_electrodomestico: int
    id_estado_dispositivo: int
    fecha: datetime
    imperfecciones: Optional[str] = None
    telefono: Optional[str] = None
    total_dispositivos: int
    usuario: Optional[Usuario] = None
    tipo: Optional[TipoElectrodomestico] = None
    estado: Optional[EstadoDispositivo] = None

class DonacionUpdate(BaseModel):
    id_tipo_electrodomestico: int
    id_estado_dispositivo: int
    fecha: datetime
    imperfecciones: Optional[str] = None
    telefono: Optional[str] = None
    total_dispositivos: int

# Configuración de FastAPI
app = FastAPI(
    title="EcoReboot API - Donaciones",
    description="API para gestionar el CRUD de donaciones en EcoReboot",
    version="1.0.0"
)

# CORS
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Eventos de conexión a la base de datos
@app.on_event("startup")
async def startup():
    await database.connect()

@app.on_event("shutdown")
async def shutdown():
    await database.disconnect()

# ---------------------------
# ENDPOINTS PARA DONACIONES
# ---------------------------

# 1. Listar todas las donaciones con información anidada usando alias en columnas
@app.get("/donaciones/", response_model=List[Donacion], tags=["Donaciones"])
async def listar_donaciones():
    query = select(
        donaciones.c.id_donacion,
        donaciones.c.id_usuario,
        donaciones.c.id_tipo_electrodomestico,
        donaciones.c.id_estado_dispositivo,
        donaciones.c.fecha,
        donaciones.c.imperfecciones,
        donaciones.c.telefono,
        donaciones.c.total_dispositivos,
        # Alias para evitar conflictos:
        usuarios.c.nombre.label("usuario_nombre"),
        usuarios.c.telefono.label("usuario_telefono"),
        usuarios.c.correo.label("usuario_correo"),
        tipo_electrodomestico.c.nombre.label("tipo_nombre"),
        estado_dispositivo.c.nombre.label("estado_nombre")
    ).select_from(
        donaciones.join(usuarios, donaciones.c.id_usuario == usuarios.c.id_usuario)
                  .join(tipo_electrodomestico, donaciones.c.id_tipo_electrodomestico == tipo_electrodomestico.c.id_tipo_electrodomestico)
                  .join(estado_dispositivo, donaciones.c.id_estado_dispositivo == estado_dispositivo.c.id_estado_dispositivo)
    ).order_by(donaciones.c.id_donacion)

    rows = await database.fetch_all(query)
    donaciones_list = []
    for row in rows:
        donacion = {
            "id_donacion": row["id_donacion"],
            "id_usuario": row["id_usuario"],
            "id_tipo_electrodomestico": row["id_tipo_electrodomestico"],
            "id_estado_dispositivo": row["id_estado_dispositivo"],
            "fecha": row["fecha"],
            "imperfecciones": row["imperfecciones"],
            "telefono": row["telefono"],
            "total_dispositivos": row["total_dispositivos"],
            "usuario": {
                "id_usuario": row["id_usuario"],
                "nombre": row["usuario_nombre"],
                "telefono": row["usuario_telefono"],
                "correo": row["usuario_correo"],
                "rol": None
            },
            "tipo": {
                "id_tipo_electrodomestico": row["id_tipo_electrodomestico"],
                "nombre": row["tipo_nombre"]
            },
            "estado": {
                "id_estado_dispositivo": row["id_estado_dispositivo"],
                "nombre": row["estado_nombre"]
            }
        }
        donaciones_list.append(donacion)
    return donaciones_list

# 2. Mostrar una donación por ID (con alias en la consulta)
@app.get("/donaciones/{donation_id}", response_model=Donacion, tags=["Donaciones"])
async def obtener_donacion(donation_id: int):
    query = select(
        donaciones.c.id_donacion,
        donaciones.c.id_usuario,
        donaciones.c.id_tipo_electrodomestico,
        donaciones.c.id_estado_dispositivo,
        donaciones.c.fecha,
        donaciones.c.imperfecciones,
        donaciones.c.telefono,
        donaciones.c.total_dispositivos,
        usuarios.c.nombre.label("usuario_nombre"),
        usuarios.c.telefono.label("usuario_telefono"),
        usuarios.c.correo.label("usuario_correo"),
        tipo_electrodomestico.c.nombre.label("tipo_nombre"),
        estado_dispositivo.c.nombre.label("estado_nombre")
    ).select_from(
        donaciones.join(usuarios, donaciones.c.id_usuario == usuarios.c.id_usuario)
                  .join(tipo_electrodomestico, donaciones.c.id_tipo_electrodomestico == tipo_electrodomestico.c.id_tipo_electrodomestico)
                  .join(estado_dispositivo, donaciones.c.id_estado_dispositivo == estado_dispositivo.c.id_estado_dispositivo)
    ).where(donaciones.c.id_donacion == donation_id)

    row = await database.fetch_one(query)
    if row is None:
        raise HTTPException(status_code=404, detail="Donación no encontrada")
    donacion = {
        "id_donacion": row["id_donacion"],
        "id_usuario": row["id_usuario"],
        "id_tipo_electrodomestico": row["id_tipo_electrodomestico"],
        "id_estado_dispositivo": row["id_estado_dispositivo"],
        "fecha": row["fecha"],
        "imperfecciones": row["imperfecciones"],
        "telefono": row["telefono"],
        "total_dispositivos": row["total_dispositivos"],
        "usuario": {
            "id_usuario": row["id_usuario"],
            "nombre": row["usuario_nombre"],
            "telefono": row["usuario_telefono"],
            "correo": row["usuario_correo"],
            "rol": None
        },
        "tipo": {
            "id_tipo_electrodomestico": row["id_tipo_electrodomestico"],
            "nombre": row["tipo_nombre"]
        },
        "estado": {
            "id_estado_dispositivo": row["id_estado_dispositivo"],
            "nombre": row["estado_nombre"]
        }
    }
    return donacion

# 3. Actualizar (editar) una donación
@app.put("/donaciones/{donation_id}", response_model=Donacion, tags=["Donaciones"])
async def editar_donacion(donation_id: int, datos: DonacionUpdate):
    update_query = donaciones.update().where(donaciones.c.id_donacion == donation_id).values(
        id_tipo_electrodomestico=datos.id_tipo_electrodomestico,
        id_estado_dispositivo=datos.id_estado_dispositivo,
        fecha=datos.fecha,
        imperfecciones=datos.imperfecciones,
        telefono=datos.telefono,
        total_dispositivos=datos.total_dispositivos
    )
    result = await database.execute(update_query)
    if not result:
        raise HTTPException(status_code=404, detail="Donación no encontrada")
    return await obtener_donacion(donation_id)

# 4. Eliminar una donación
@app.delete("/donaciones/{donation_id}", tags=["Donaciones"])
async def eliminar_donacion(donation_id: int):
    delete_query = donaciones.delete().where(donaciones.c.id_donacion == donation_id)
    result = await database.execute(delete_query)
    if not result:
        raise HTTPException(status_code=404, detail="Donación no encontrada")
    return {"message": "¡Donación eliminada con éxito!"}


# ---------------------------
# ENDPOINTS PARA USUARIOS
# ---------------------------

# Endpoint 1: Obtener todos los usuarios (incluyendo información del rol)
rol_usuarios = sqlalchemy.Table(
    "rol_usuarios",
    metadata,
    sqlalchemy.Column("id_rol_usuario", sqlalchemy.Integer, primary_key=True),
    sqlalchemy.Column("nombre", sqlalchemy.String(100))
)

@app.get("/usuarios/", response_model=List[Usuario], tags=["Usuarios"])
async def obtener_usuarios():
    query = select(
        usuarios.c.id_usuario,
        usuarios.c.nombre,
        usuarios.c.telefono,
        usuarios.c.correo,
        usuarios.c.id_rol_usuario,
        rol_usuarios.c.nombre.label("rol_nombre")

    ).select_from(
        usuarios.join(rol_usuarios, usuarios.c.id_rol_usuario == rol_usuarios.c.id_rol_usuario)
    )
    rows = await database.fetch_all(query)
    usuarios_list = []
    for row in rows:
        user = {
            "id_usuario": row["id_usuario"],
            "nombre": row["nombre"],
            "telefono": row["telefono"],
            "correo": row["correo"],
            "rol": {
                "id_rol_usuario": row["id_rol_usuario"],
                "nombre": row["rol_nombre"]
            }
        }
        usuarios_list.append(user)
    return usuarios_list

# Endpoint 2: Obtener un solo usuario por su id
@app.get("/usuarios/{usuario_id}", response_model=Usuario, tags=["Usuarios"])
async def obtener_usuario(usuario_id: int):
    query = select(
        usuarios.c.id_usuario,
        usuarios.c.nombre,
        usuarios.c.telefono,
        usuarios.c.correo,
        usuarios.c.id_rol_usuario,
        rol_usuarios.c.nombre.label("rol_nombre")
    ).select_from(
        usuarios.join(rol_usuarios, usuarios.c.id_rol_usuario == rol_usuarios.c.id_rol_usuario)
    ).where(usuarios.c.id_usuario == usuario_id)
    row = await database.fetch_one(query)
    if not row:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    user = {
        "id_usuario": row["id_usuario"],
        "nombre": row["nombre"],
        "telefono": row["telefono"],
        "correo": row["correo"],
        "rol": {
            "id_rol_usuario": row["id_rol_usuario"],
            "nombre": row["rol_nombre"]
        }
    }
    return user

# Modelo para crear/editar un usuario
class UsuarioCreate(BaseModel):
    nombre: str
    telefono: str
    correo: str
    id_rol_usuario: int

# Endpoint 3: Crear un nuevo usuario
@app.post("/usuarios/", response_model=Usuario, tags=["Usuarios"])
async def crear_usuario(usuario: UsuarioCreate):
    query = usuarios.insert().values(
        nombre=usuario.nombre,
        telefono=usuario.telefono,
        correo=usuario.correo,
        id_rol_usuario=usuario.id_rol_usuario
    )
    usuario_id = await database.execute(query)
    return await obtener_usuario(usuario_id)

# Endpoint 4: Editar un usuario por su id
@app.put("/usuarios/{usuario_id}", response_model=Usuario, tags=["Usuarios"])
async def editar_usuario(usuario_id: int, usuario: UsuarioCreate):
    query = usuarios.update().where(usuarios.c.id_usuario == usuario_id).values(
        nombre=usuario.nombre,
        telefono=usuario.telefono,
        correo=usuario.correo,
        id_rol_usuario=usuario.id_rol_usuario
    )
    await database.execute(query)
    return await obtener_usuario(usuario_id)

# Endpoint 5: Eliminar usuario por su id
@app.delete("/usuarios/{usuario_id}", tags=["Usuarios"])
async def eliminar_usuario(usuario_id: int):
    query = usuarios.delete().where(usuarios.c.id_usuario == usuario_id)
    result = await database.execute(query)
    if not result:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    return {"message": "¡Usuario eliminado con éxito!"}


# -------------------------------------------------
# ENDPOINT PARA CREAR UNA DONACIÓN POR USUARIO
# -------------------------------------------------

# Modelo para crear una donación a partir de un usuario (sin incluir id_usuario en el body)
class DonacionByUserCreate(BaseModel):
    id_tipo_electrodomestico: int
    id_estado_dispositivo: int
    fecha: datetime
    imperfecciones: Optional[str] = None
    telefono: Optional[str] = None
    total_dispositivos: int

# Endpoint: Crear una donación usando el id del usuario proporcionado en la URL
@app.post("/usuarios/{usuario_id}/donaciones", response_model=Donacion, tags=["Donaciones"])
async def crear_donacion_por_usuario(usuario_id: int, datos: DonacionByUserCreate):
    insert_query = donaciones.insert().values(
        id_usuario=usuario_id,
        id_tipo_electrodomestico=datos.id_tipo_electrodomestico,
        id_estado_dispositivo=datos.id_estado_dispositivo,
        fecha=datos.fecha,
        imperfecciones=datos.imperfecciones,
        telefono=datos.telefono,
        total_dispositivos=datos.total_dispositivos
    )
    new_id = await database.execute(insert_query)
    return await obtener_donacion(new_id)



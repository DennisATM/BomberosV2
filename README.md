# BomberosV2

PHP, JS, MARIADB, API TWITER.

Sistema Web para central de emergencias Bomberiles.

Cuenta con modulos de mantenimiento:
Empresa, compañias, usuarios, vehiculos, tipos de emergencia.

Vista Genral por Compañía: Se muestra el total de operarios de la compañía, los usuarios y vehiculos disponibles, así como las ultimas 4 emergencias asignadas a dicha compañía.

Módulo para asignación de vehículos a conductores, la asignación discrimina los vehículos según la compañía a la que pertenece el conductor.

Módulo de Emergencias: 
Crear: Se asigna una emergencia a Compañía/vehículo/Conductor y se envia notificación Via Twitter a los usuarios que siguen la cuenta del Cuerpo de Bomberos.
Borrar: Elimina registro de emergencia y libera a conductor/vehiculo/usuarios asignados.
Cerrar: Cierra la emergencia, liberando a vehiculo/conductor/usuarios asignados.

Módulo Estados:
Disponibilidad: Cada usuario logueado, tiene la posibilidad de colocar su estado como "Disponible" o "No Disponible", se valida que el un usuario no puede estar disponible por más de 24 horas. Caso  contrario, el sistema le asigna estado de "No Disponible".
Lista de Asistencia: Al reportarse la emergencia y asignarse a una compañía "X", se designa a un usuario que realice la lista (o seleccione en el sistema) de usuarios de dicha compañía que tengan el estado "Disponible" para asistir a dicha emergencia. Al cerrar la emergencia, se liberan los usuarios asignados.

Modulo Usuario: Con opciones generales para cambio de Clave, fotografía de Avatar y Cerrar la Sesión.

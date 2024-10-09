# E2-BDD-BananerApp

## Aplicación cargadora de datos en PHP

Construya una aplicación cargadora de datos haciendo uso de PHP. Al igual que la entrega E0, su grupo deberá cargar los datos desde los archivos entregados mediante el cargador mencionado, pero esta vez el destino son las tablas de su base de datos. El cargador puede ser ejecutado por línea de comando (CLI), no es necesario que sea una aplicación web. El cargador deberá:

- Leer todos los datos o una parte de ellos e insertarlos correctamente en las tablas, validando todas las restricciones de integridad y formatos indicados en el enunciado y reflejados en su esquema.
- Las tuplas que violen las restricciones de integridad y atributos que violen el formato deberán ser almacenadas en un archivo para posterior análisis y, si procede, su corrección.

**Nota**: Puede separar el archivo de datos en varios CSV si lo encuentra necesario.

### 4. Análisis de datos rechazados

Una vez cargados todos los datos que no violen las restricciones, su grupo deberá analizar los datos rechazados e intentar recuperar lo máximo posible. Las alternativas son:

- **Corregir**: Si usted tiene información adicional o alguna buena razón, puede reemplazar los datos conflictivos con datos válidos (por ejemplo, si hay un teléfono de 8 cifras, se puede anteponer un 9 o si un correo electrónico tiene un carácter inválido como el espacio en blanco, eliminarlo).
- **Reemplazar**: Si no se puede corregir el dato, se puede reemplazar por un valor que sea permitido por el dominio del atributo, pero que simbolice que el valor es nulo y así no se pierden los otros datos que vienen en la tupla (por ejemplo, si el teléfono contiene una letra, claramente es inválido, por lo que se puede reemplazar por 0 o nulo).
- **Descartar**: Si no hay otra opción, la tupla se debe descartar en cascada.

#### Notas:

- **Nota 1**: En algunos atributos será necesario estandarizar los valores a un conjunto de valores acotados, por ejemplo, el último logro debe soportar los valores indicados (2 años equivale a nivel 4).
- **Nota 2**: A diferencia de la E0, en esta ocasión los datos originales **NO SE PUEDEN MODIFICAR**, solo se permite modificar el archivo de los datos que violen las restricciones de integridad y los formatos, los cuales deben ser cargados siempre con la aplicación PHP cargadora de datos.
- **Nota 3**: Es recomendable que su aplicación pueda detectar y corregir formatos (sanitización de input).

### 5. Aplicación web en PHP

Construya en PHP una aplicación web simple, según el modelo que se acompaña, que solicite el ID (email institucional) y clave (8 caracteres alfanuméricos). Si ambos coinciden, se debe desplegar un menú que contenga las siguientes funcionalidades:

- Entregar un reporte de la cantidad de estudiantes vigentes (tomaron cursos en 2024-2) que están dentro y fuera de nivel. Dentro de nivel significa que su cohorte corresponde con su último logro. Por ejemplo, cohorte 2020-1 corresponde a un último logro de 9° semestre (el período vigente es 2024-2).
- Entregar el curso (código y nombre), el nombre del profesor y el porcentaje de aprobación para un período ingresado como parámetro por la aplicación.
- Entregar para un curso (código) ingresado como parámetro, el promedio del porcentaje de aprobación histórico agrupado por profesor.
- Entregar una propuesta de toma de ramos (solo códigos) para el 2025-1, suponiendo que el estudiante ingresado como parámetro (número de estudiante) aprueba todos los cursos vigentes. Debe controlarse que el estudiante esté vigente en 2024-2.
- Entregar el historial académico de un estudiante (número de estudiante) ingresado como parámetro, conteniendo el detalle de todos sus cursos realizados y vigentes, agrupados por período académico en orden ascendente, con su nota final y calificación. Al final de cada período, debe incluir un resumen del número de cursos aprobados, reprobados y vigentes, junto al promedio del período (PPS). Al final del reporte, se debe agregar el resumen total de los cursos aprobados, reprobados y vigentes, junto al promedio del período (PPA), y si el estudiante está vigente (tomó cursos en el período vigente), no vigente o de término (licenciado o titulado).
- Dado un curso del semestre vigente (su grupo elige uno), lea desde un archivo CSV que su grupo debe generar, los datos de los números de alumno y notas finales para ambas convocatorias, e insertarlas en la base de datos (nota y calificación). Una vez realizado, debe generar un acta de notas indicando el curso (sigla y nombre), alumno (RUN, número de alumno, nombre), convocatoria, nota y calificación obtenida, así como los datos que no pudieron ingresarse. El archivo debe contener al menos una instancia de nota-calificación de la tabla y un estudiante que no esté en la lista.

### BONUS:

Dado un período, entregue una lista de todos los estudiantes "Desertores", es decir, que se retiraron (ya sea oficialmente) de la universidad o suspendieron por más de 2 semestres sin reincorporarse.

<?php
// creamos la clase
class basededatos
{
    // variable para la conexión
    private $conn;

    // Método constructor que realiza la conexión
    public function __construct()
    {
        $config = parse_ini_file(__DIR__ . '/config.inc.ini');
        try {
            $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $dsn = 'mysql:host=' . $config['server'] . ';dbname=' . $config['base'];
            $this->conn = new PDO($dsn, $config['user'], $config['pass'], $opc);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    // método que ejecuta la consulta
    private function ejecutaConsulta($sql)
    {
        try {
            $resultado = null;
            if (isset($this->conn)) $resultado = $this->conn->query($sql);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    // Método público que comprueba usuario de un login
    public function comprobarUsuario($user, $pass)
    {
        // Comprobar si el usuario existe
        $sql = "SELECT * FROM usuarios WHERE nombre='$user' LIMIT 1";
        $resultado = $this->ejecutaConsulta($sql);

        if ($resultado) {
            $datos = $resultado->Fetch(PDO::FETCH_ASSOC);
            // Verificar la contraseña
            if ($datos) {
                if ($datos['clave'] === $pass) {
                    return $datos; // Credenciales correctas
                } else {
                    return 'incorrect'; // Contraseña incorrecta
                }
            } else {
                return 'not_found'; // Usuario no encontrado
            }
        }
        return false; // En caso de error en la consulta
    }

    // Verificar si ya existe un usuario con ese nombre, email o dni
    public function usuarioRegistrado($datos)
    {
        $datos = unserialize($datos);
        $user = $datos[1];
        $dni = $datos[2];
        $email = $datos[3];

        $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre = :user OR email = :email OR DNI = :dni";
        $resultado = $this->conn->prepare($sql);
        $resultado->bindParam(':user', $user);
        $resultado->bindParam(':email', $email);
        $resultado->bindParam(':dni', $dni);
        $resultado->execute();
        $existeUsu = $resultado->fetchColumn();

        return $existeUsu > 0; // Devuelve true si el usuario existe, false si no
    }

    // método para establecer un nuevo usuario
    public function setUsuario($datos)
    {
        $datos = unserialize($datos);
        $this->conn->beginTransaction();
        $sql = "INSERT INTO usuarios (id_usuario, nombre, DNI, email, clave, tipo_usu) VALUES (?,?,?,?,?,?);";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(array(0, $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]));
        $this->conn->commit();
    }

    // método para ver los usuarios
    public function getUsuarios()
    {
        $sql = 'SELECT * FROM usuarios ORDER BY id_usuario';
        $resultado = $this->ejecutaConsulta($sql);
        if ($resultado) {
            $datos = $resultado->FetchAll();
            return $datos;
        }
    }

    // método para ver el usuario cuyo id coincida con el recibido por parámetro
    public function getUsuarioId($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id_usuario=$id";
        $resultado = $this->ejecutaConsulta($sql);
        if ($resultado) {
            $datos = $resultado->Fetch();
            return $datos;
        }
    }

    public function getUsuarioPorNombre($nombre)
    {
        $sql = 'SELECT * FROM usuarios WHERE nombre = :nombre';
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(['nombre' => $nombre]);
        $datos = $resultado->fetch(PDO::FETCH_ASSOC);
        return $datos;
    }

    // método para actualizar los datos de un usuario cuyo id coincida con el recibido en el array serializado
    public function updateUsuario($datos)
    {
        $datos = unserialize($datos);
        $this->conn->beginTransaction();
        $sql = "UPDATE usuarios SET nombre= ?, DNI= ?, email= ?, clave= ?, tipo_usu = ? WHERE id_usuario = ?;";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(array($datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[0]));
        $this->conn->commit();
    }

    // método para eliminar un usuario cuyo id coincida con el recibido por parámetro
    public function delUsuario($id)
    {
        $sql = "DELETE FROM usuarios WHERE id_usuario=$id";
        $resultado = $this->ejecutaConsulta($sql);
        return $resultado !== false; // Devuelve true si la consulta fue bien
    }

    // método para crear una nueva receta
    public function crearReceta($datos)
    {
        $datos = unserialize($datos);   
        $this->conn->beginTransaction();
        $sql = "INSERT INTO recetas (id_receta, titulo, ingredientes, tiempo_preparacion, tiempo_total, instrucciones, id_usuario, publica, imagen) VALUES (?,?,?,?,?,?,?,?,?);";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(array(0, $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8]));
        $this->conn->commit();
    }
    // método para ver las recetas de un usuario cuyo id coincida con el recibido por parámetro
    public function getRecetasPorUsuario($id_usuario)
    {
        $sql = 'SELECT r.*, u.nombre AS autor
            FROM recetas r
            JOIN usuarios u ON r.id_usuario = u.id_usuario
            WHERE r.id_usuario = :id_usuario
            ORDER BY r.id_receta';
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(['id_usuario' => $id_usuario]);
        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    // método para ver todas las recetas
    public function getRecetas()
    {
        $sql = 'SELECT r.*, u.nombre AS autor 
                FROM recetas r 
                JOIN usuarios u ON r.id_usuario = u.id_usuario 
                ORDER BY r.id_receta';
        $resultado = $this->ejecutaConsulta($sql);
        if ($resultado) {
            $datos = $resultado->FetchAll();
            return $datos;
        }
    }

    // método para ver la receta cuyo id coincida con el recibido por parámetro
    public function getRecetaId($id)
    {
        $sql = "SELECT * FROM recetas WHERE id_receta=$id";
        $resultado = $this->ejecutaConsulta($sql);
        if ($resultado) {
            $datos = $resultado->Fetch();
            return $datos;
        }
    }

    // metodo para ver las recetas publicas
    public function getRecetasPublicas()
    {
        $sql = 'SELECT r.*, u.nombre AS autor 
                FROM recetas r 
                JOIN usuarios u ON r.id_usuario = u.id_usuario 
                WHERE r.publica = 1 
                ORDER BY r.id_receta';
        $resultado = $this->ejecutaConsulta($sql);
        if ($resultado) {
            $datos = $resultado->FetchAll();
            return $datos;
        }
        return [];
    }
    //metodo para comprobar si una receta está guardada por el usuario
    public function recetaGuardada($datos)
    {
        $datos = unserialize($datos);
        $id_usuario = $datos[1];
        $id_receta = $datos[2];
        $sql = "SELECT COUNT(*) FROM usuario_receta WHERE id_usuario = ? AND id_receta = ?";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute([$id_usuario, $id_receta]);
        return $resultado->fetchColumn();
    }
    //metodo para comprobar si un usuaqrio es autor de la receta que quiere guardar
    public function esAutorReceta($id_usuario, $id_receta)
    {
        $sql = "SELECT COUNT(*) FROM recetas WHERE id_receta = ? AND id_usuario = ?";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute([$id_receta, $id_usuario]);
        return $resultado->fetchColumn() > 0;
    }

    // método para guardar una receta pública en la lista usuario_receta
    public function addReceta($datos)
    {
        $datos = unserialize($datos);
        $this->conn->beginTransaction();
        $sql = "INSERT INTO usuario_receta (id_usuario, id_receta) VALUES (?,?);";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(array($datos[1], $datos[2]));
        $this->conn->commit();
    }


    // método para ver las recetas guardadas por un usuario
    public function getRecetasGuardadasPorUsuario($id_usuario)
    {
        $sql = "SELECT r.*, u.nombre AS autor
            FROM recetas r
            JOIN usuario_receta ur ON r.id_receta = ur.id_receta
            JOIN usuarios u ON r.id_usuario = u.id_usuario
            WHERE ur.id_usuario = ?";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute([$id_usuario]);
        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    // método para actualizar los datos de una receta cuyo id coincida con el recibido en el array serializado
    public function updateReceta($datos)
    {
        $datos = unserialize($datos);
        $this->conn->beginTransaction();

        // Verificar si se ha proporcionado una nueva imagen o si se debe eliminar la imagen actual
        if ($datos[8] !== null) {
            if ($datos[8] === '') {
                $sql = "UPDATE recetas SET titulo= ?, ingredientes= ?, tiempo_preparacion= ?, tiempo_total= ?, instrucciones = ?, publica = ?, imagen = NULL WHERE id_receta = ?;";
                $params = array($datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[7], $datos[0]);
            } else {
                $sql = "UPDATE recetas SET titulo= ?, ingredientes= ?, tiempo_preparacion= ?, tiempo_total= ?, instrucciones = ?, publica = ?, imagen = ? WHERE id_receta = ?;";
                $params = array($datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[7], $datos[8], $datos[0]);
            }
        } else {
            $sql = "UPDATE recetas SET titulo= ?, ingredientes= ?, tiempo_preparacion= ?, tiempo_total= ?, instrucciones = ?, publica = ? WHERE id_receta = ?;";
            $params = array($datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[7], $datos[0]);
        }

        $resultado = $this->conn->prepare($sql);
        $resultado->execute($params);
        $this->conn->commit();
    }

    // método para eliminar una receta cuyo id coincida con el recibido por parámetro
    public function delReceta($id)
    {
        $sql = "DELETE FROM recetas WHERE id_receta=$id";
        $resultado = $this->ejecutaConsulta($sql);
        return $resultado !== false; // Devuelve true si la consulta fue bien
    }


    public function delRecetaGuardada($id_usuario, $id_receta)
    {
        $sql = "DELETE FROM usuario_receta WHERE id_usuario = ? AND id_receta = ?";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute([$id_usuario, $id_receta]);
    }

    // método para ver todas las notificaciones
    public function getNotificaciones()
    {
        $sql = "SELECT n.*, 
                   u.nombre AS cliente_nombre, 
                   r.nombre AS remitente_nombre 
            FROM notificaciones n 
            JOIN usuarios u ON n.cliente_ID = u.id_usuario 
            JOIN usuarios r ON n.remitente_ID = r.id_usuario
            ORDER BY n.creado_en DESC";
        $resultado = $this->ejecutaConsulta($sql);
        if ($resultado) {
            $datos = $resultado->FetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
    }

    // método para ver una notificación cuyo id coincida con el recibido por parámetro
    public function getNotificacionId($id)
    {
        $sql = 'SELECT * FROM notificaciones WHERE id_notificacion = :id_notificacion';
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(['id_notificacion' => $id]);
        $datos = $resultado->fetch(PDO::FETCH_ASSOC);
        return $datos;
    }



    // método para obtener las notificaciones de un usuario cuyo id coincida con el recibido por parámetro
    public function getNotificacionesPorUsuario($id_usuario)
    {
        $sql = "SELECT n.*, 
                   r.nombre AS remitente_nombre 
            FROM notificaciones n 
            JOIN usuarios u ON n.cliente_ID = u.id_usuario 
            JOIN usuarios r ON n.remitente_ID = r.id_usuario
            WHERE n.cliente_ID = :id_usuario
            ORDER BY n.creado_en DESC";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(['id_usuario' => $id_usuario]);
        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    // método para crear una notificación
    public function crearNotificacion($remitente_ID, $destinatario, $mensaje)
    {
        if ($destinatario === 'soporte') {
            // Obtener todos los administradores
            $sql = "SELECT id_usuario FROM usuarios WHERE tipo_usu = 'admin'";
            $resultado = $this->conn->prepare($sql);
            $resultado->execute();
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

            // Insertar notificación para cada administrador
            foreach ($datos as $admin) {
                $this->insertarNotificacion($remitente_ID, $admin['id_usuario'], $mensaje);
            }
        } elseif ($destinatario === 'global') {
            // Obtener todos los usuarios
            $sql = "SELECT id_usuario FROM usuarios";
            $resultado = $this->conn->prepare($sql);
            $resultado->execute();
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

            // Insertar notificación para cada usuario
            foreach ($datos as $usuario) {
                $this->insertarNotificacion($remitente_ID, $usuario['id_usuario'], $mensaje);
            }
        } else {
            // Obtener el ID del destinatario por nombre
            $sql = "SELECT id_usuario FROM usuarios WHERE nombre = :nombre";
            $resultado = $this->conn->prepare($sql);
            $resultado->bindValue(':nombre', $destinatario);
            $resultado->execute();
            $datos = $resultado->fetch(PDO::FETCH_ASSOC);

            if ($datos) {
                $this->insertarNotificacion($remitente_ID, $datos['id_usuario'], $mensaje);
            } else {
                throw new Exception("Usuario no encontrado");
            }
        }
    }

    public function insertarNotificacion($remitente_ID, $cliente_ID, $mensaje)
    {
        // Insertar en la tabla notificaciones
        $sql = "INSERT INTO notificaciones (remitente_ID, cliente_ID, mensaje, leida)
            VALUES (:remitente_ID, :cliente_ID, :mensaje, 0)";
        $resultado = $this->conn->prepare($sql);
        $resultado->bindValue(':remitente_ID', $remitente_ID);
        $resultado->bindValue(':cliente_ID', $cliente_ID);
        $resultado->bindValue(':mensaje', $mensaje);
        $resultado->execute();

        // Obtener el ID de la notificación recién insertada
        $id_notificacion = $this->conn->lastInsertId();

        // Insertar en la tabla usuario_notificacion
        $sql = "INSERT INTO usuario_notificacion (id_usuario, id_notificacion, leida)
            VALUES (:id_usuario, :id_notificacion, 0)";
        $resultado = $this->conn->prepare($sql);
        $resultado->bindValue(':id_usuario', $cliente_ID);
        $resultado->bindValue(':id_notificacion', $id_notificacion);
        $resultado->execute();
    }

    // método para marcar una notificación como leída
    public function marcarNotificacionLeida($id_usuario, $id_notificacion)
    {
        // Actualizar la tabla usuario_notificacion
        $sql = 'UPDATE usuario_notificacion SET leida = 1 WHERE id_usuario = :id_usuario AND id_notificacion = :id_notificacion';
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(['id_usuario' => $id_usuario, 'id_notificacion' => $id_notificacion]);

        // Actualizar la tabla notificaciones
        $sql = 'UPDATE notificaciones SET leida = 1 WHERE id_notificacion = :id_notificacion';
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(['id_notificacion' => $id_notificacion]);
    }

    // metodo para ver las notificaciones no leídas del usuario cuyo id coincida con el recibido por parámetro
    public function getNotificacionesNoLeidas($id_usuario)
    {
        $sql = 'SELECT n.*, un.leida, u.nombre AS remitente_nombre
            FROM notificaciones n
            JOIN usuario_notificacion un ON n.id_notificacion = un.id_notificacion
            JOIN usuarios u ON n.remitente_ID = u.id_usuario
            WHERE un.id_usuario = :id_usuario AND un.leida = 0';
        $resultado = $this->conn->prepare($sql);
        $resultado->execute(['id_usuario' => $id_usuario]);
        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    // método para eliminar una notificación cuyo id coincida con el recibido por parámetro
    public function delNotificacion($id)
    {
        try {
            $this->conn->beginTransaction();

            // Eliminar de la tabla usuario_notificacion
            $sql = "DELETE FROM usuario_notificacion WHERE id_notificacion = ?";
            $resultado = $this->conn->prepare($sql);
            $resultado->execute([$id]);

            // Eliminar de la tabla notificaciones
            $sql = "DELETE FROM notificaciones WHERE id_notificacion = ?";
            $resultado = $this->conn->prepare($sql);
            $resultado->execute([$id]);

            $this->conn->commit();
        } catch (Exception $ex) {
            $this->conn->rollBack();
            throw $ex;
        }
    }

    // método para actualizar la notificación en la base de datos
    public function updateNotificacion($datos)
    {
        $datos = unserialize($datos);
        try {
            $this->conn->beginTransaction();

            // Actualizar solo el campo mensaje en la tabla notificaciones
            $sql = "UPDATE notificaciones SET mensaje = ? WHERE id_notificacion = ?;";
            $resultado = $this->conn->prepare($sql);
            $resultado->execute(array($datos[3], $datos[0]));
            $this->conn->commit();
        } catch (Exception $ex) {
            $this->conn->rollBack();
            throw $ex;
        }
    }
}

<?php include_once('views/head/head.php');
$usuario = $_SESSION['nombre_usuario'];

?>
<header>

    <nav class="navbar bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <label class="navbar-brand">
                Bienvenido <?php echo $usuario ?>
            </label>
        </div>
    </nav>
</header>
<section>
    <div class="container text-center">
        <div class="container-fluid">
            <div class="row g-2">
                <div class="col py-3">
                    
                    <a class="btn btn-primary d-grid gap-2" href="controller/personas/controller.personas.php"
                        role="button">Personas</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/pacientes/controller.pacientes.php"
                        role="button">Pacientes</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/medicos/controller.medicos.php"
                        role="button">Medicos</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/empleados/controller.empleados.php"
                        role="button">Empleados</a>
                </div>
            </div>
            <div class="row g-2">
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/direcciones/controller.direccion.php"
                        role="button">Direcciones</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/contactos/controller.contactos.php"
                        role="button">Contactos</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2"
                        href="controller/documentaciones/controller.documentaciones.php"
                        role="button">Documentaciones</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/calles/controller.calles.php"
                        role="button">Calles</a>
                </div>
            </div>
            <div class="row g-2">
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/barrios/controller.barrios.php"
                        role="button">Barrios</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/localidades/controller.localidades.php"
                        role="button">Localidades</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/provincias/controller.provincias.php"
                        role="button">Provincias</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2" href="controller/paises/controller.paises.php"
                        role="button">Paises</a>
                </div>
                <div class="col py-3">
                    <a class="btn btn-primary d-grid gap-2"
                        href="controller/puestos-trabajos/controller.puestos-trabajos.php" role="button">Puestos de
                        Trabajos</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once('views/head/footer.php'); ?>
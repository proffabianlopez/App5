<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Usuario |  Historia Clínica</title>
		<?php include('include/head.php'); ?> 
	</head>
	<body>
		<div id="app">		
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">
				<?php include('include/header.php'); ?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Usuario | Historia Clínica</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Usuario</span>
									</li>
									<li class="active">
										<span>Ver historia clínica</span>
									</li>
								</ol>
							</div>
						</section>
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Ver <span class="text-bold">Historia clínica</span></h5>
									<table class="table table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th class="center">#</th>
											<th>Nombre del Paciente</th>
											<th>Teléfono del Paciente</th>
											<th>Género del Paciente</th>
											<th>Fecha de Creación</th>
											<th>Fecha de Actualización</th>
											<th>Acción</th>
										</tr>
									</thead>

										<tbody>
											<tr>
												<td class="center">1.</td>
												<td class="hidden-xs">John Doe</td>
												<td>1234567890</td>
												<td>Masculino</td>
												<td>2024-09-01</td>
												<td>2024-09-10</td>
												<td>
													<!-- funcion de php  -->
													<!-- <a href="view-medhistory.php?viewid=1"><i class="fa fa-eye"></i></a> -->
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include('include/footer.php'); ?>
			<?php include('include/setting.php'); ?>
		</div>
        <?php include('include/script.php'); ?> 
	</body>
</html>

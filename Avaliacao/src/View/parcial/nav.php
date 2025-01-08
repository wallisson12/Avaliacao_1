<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Session_Handler;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<?php if (Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
						<a class="nav-link" href=<?php Ambiente::getUrl('Usuario/indexCadastrar', true) ?>>Cadastrar Usuário</a>
					<?php } else { ?>
						<span class="nav-link disabled">Cadastrar Usuário</span>
					<?php } ?>
				</li>
				<li class="nav-item">
					<a class="nav-link" href=<?php Ambiente::getUrl('Usuario/listar', true) ?>>Listar Usuários</a>
				</li>
				<li class="nav-item">
					<?php if (Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
						<a class="nav-link" href=<?php Ambiente::getUrl('Filiado/indexCadastrar', true) ?>>Cadastrar Filiado</a>
					<?php } else { ?>
						<span class="nav-link disabled">Cadastrar Filiado</span>
					<?php } ?>
				</li>
				<li class="nav-item">
					<a class="nav-link" href=<?php Ambiente::getUrl('Filiado/listar', true) ?>>Listar Filiados</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href=<?php Ambiente::getUrl('Usuario/logout', true) ?>>Logout</a>
				</li>
			</ul>
		</div>
	</div>
</nav>



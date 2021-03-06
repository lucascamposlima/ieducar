<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*																	     *
	*	@author Prefeitura Municipal de Itaja�								 *
	*	@updated 29/03/2007													 *
	*   Pacote: i-PLB Software P�blico Livre e Brasileiro					 *
	*																		 *
	*	Copyright (C) 2006	PMI - Prefeitura Municipal de Itaja�			 *
	*						ctima@itajai.sc.gov.br					    	 *
	*																		 *
	*	Este  programa  �  software livre, voc� pode redistribu�-lo e/ou	 *
	*	modific�-lo sob os termos da Licen�a P�blica Geral GNU, conforme	 *
	*	publicada pela Free  Software  Foundation,  tanto  a vers�o 2 da	 *
	*	Licen�a   como  (a  seu  crit�rio)  qualquer  vers�o  mais  nova.	 *
	*																		 *
	*	Este programa  � distribu�do na expectativa de ser �til, mas SEM	 *
	*	QUALQUER GARANTIA. Sem mesmo a garantia impl�cita de COMERCIALI-	 *
	*	ZA��O  ou  de ADEQUA��O A QUALQUER PROP�SITO EM PARTICULAR. Con-	 *
	*	sulte  a  Licen�a  P�blica  Geral  GNU para obter mais detalhes.	 *
	*																		 *
	*	Voc�  deve  ter  recebido uma c�pia da Licen�a P�blica Geral GNU	 *
	*	junto  com  este  programa. Se n�o, escreva para a Free Software	 *
	*	Foundation,  Inc.,  59  Temple  Place,  Suite  330,  Boston,  MA	 *
	*	02111-1307, USA.													 *
	*																		 *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
$desvio_diretorio = "";
require_once ("include/clsBase.inc.php");
require_once ("include/clsDetalhe.inc.php");
require_once ("include/clsBanco.inc.php");

class clsIndex extends clsBase
{
	
	function Formular()
	{
		$this->SetTitulo( "{$this->_instituicao} Fotos" );
		$this->processoAp = "669";
	}
}

class indice extends clsDetalhe
{
	function Gerar()
	{
		$this->titulo = "Detalhe de fotos";
		

		$id_foto = @$_GET['id_foto'];

		$objPessoa = new clsPessoaFisica();
		$db = new clsBanco();
		$db->Consulta( "SELECT f.ref_ref_cod_pessoa_fj, f.nm_credito, f.data_foto, f.titulo, f.descricao, f.caminho, f.altura, f.largura, f.ref_cod_foto_secao FROM foto_portal f WHERE cod_foto_portal={$id_foto}" );
		if ($db->ProximoRegistro())
		{
			list ($cod_pessoa, $nm_credito, $data, $titulo, $descricao, $foto, $altura, $largura, $secao ) = $db->Tupla();
			list($nome) = $objPessoa->queryRapida($cod_pessoa, "nome");
			
			$data = date('d/m/Y', strtotime(substr($data,0,19) ));
			
			

			$this->addDetalhe( array("Data", $data) );
			$this->addDetalhe( array("T&iacute;tulo", $titulo) );
			$this->addDetalhe( array("Criador", $nome) );
			$this->addDetalhe( array("Credito", $nm_credito) );
			//echo $foto;
			$this->addDetalhe( array("Foto", "<a href='#' onclick='javascript:openfoto(\"$foto\", \"$altura\",  \"$largura\")'><img src='fotos/small/{$foto}' border='0'></a>") );
		}
		$this->url_novo = "fotos_galeria_cad.php";
		$this->url_editar = "fotos_galeria_cad.php?id_foto=$id_foto";
		$this->url_cancelar = "fotos_galeria_lst.php";

		$this->largura = "100%";
	}
}


$pagina = new clsIndex();

$miolo = new indice();
$pagina->addForm( $miolo );

$pagina->MakeAll();

?>
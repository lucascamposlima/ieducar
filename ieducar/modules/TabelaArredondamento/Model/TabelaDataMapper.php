<?php

/**
 * i-Educar - Sistema de gest�o escolar
 *
 * Copyright (C) 2006  Prefeitura Municipal de Itaja�
 *                     <ctima@itajai.sc.gov.br>
 *
 * Este programa � software livre; voc� pode redistribu�-lo e/ou modific�-lo
 * sob os termos da Licen�a P�blica Geral GNU conforme publicada pela Free
 * Software Foundation; tanto a vers�o 2 da Licen�a, como (a seu crit�rio)
 * qualquer vers�o posterior.
 *
 * Este programa � distribu��do na expectativa de que seja �til, por�m, SEM
 * NENHUMA GARANTIA; nem mesmo a garantia impl��cita de COMERCIABILIDADE OU
 * ADEQUA��O A UMA FINALIDADE ESPEC�FICA. Consulte a Licen�a P�blica Geral
 * do GNU para mais detalhes.
 *
 * Voc� deve ter recebido uma c�pia da Licen�a P�blica Geral do GNU junto
 * com este programa; se n�o, escreva para a Free Software Foundation, Inc., no
 * endere�o 59 Temple Street, Suite 330, Boston, MA 02111-1307 USA.
 *
 * @author      Eriksen Costa Paix�o <eriksen.paixao_bs@cobra.com.br>
 * @category    i-Educar
 * @license     @@license@@
 * @package     TabelaArredondamento
 * @subpackage  Modules
 * @since       Arquivo dispon�vel desde a vers�o 1.1.0
 * @version     $Id$
 */

require_once 'CoreExt/DataMapper.php';
require_once 'TabelaArredondamento/Model/Tabela.php';
require_once 'RegraAvaliacao/Model/Nota/TipoValor.php';
require_once 'App/Model/IedFinder.php';

/**
 * TabelaArredondamento_Model_TabelaDataMapper class.
 *
 * @author      Eriksen Costa Paix�o <eriksen.paixao_bs@cobra.com.br>
 * @category    i-Educar
 * @license     @@license@@
 * @package     TabelaArredondamento
 * @subpackage  Modules
 * @since       Classe dispon�vel desde a vers�o 1.1.0
 * @version     @@package_version@@
 */
class TabelaArredondamento_Model_TabelaDataMapper extends CoreExt_DataMapper
{
  protected $_entityClass = 'TabelaArredondamento_Model_Tabela';
  protected $_tableName   = 'tabela_arredondamento';
  protected $_tableSchema = 'modules';

  protected $_attributeMap = array(
    'instituicao' => 'instituicao_id',
    'tipoNota'    => 'tipo_nota'
  );

  /**
   * @var TabelaArredondamento_Model_TabelaValorDataMapper
   */
  protected $_tabelaValorDataMapper = NULL;

  /**
   * Setter.
   * @param TabelaArredondamento_Model_TabelaValorDataMapper $mapper
   * @return CoreExt_DataMapper Prov� interface flu�da
   */
  public function setTabelaValorDataMapper(TabelaArredondamento_Model_TabelaValorDataMapper $mapper)
  {
    $this->_tabelaValorDataMapper = $mapper;
    return $this;
  }

  /**
   * Getter.
   * @return TabelaArredondamento_Model_TabelaValorDataMappers
   */
  public function getTabelaValorDataMapper()
  {
    if (is_null($this->_tabelaValorDataMapper)) {
      require_once 'TabelaArredondamento/Model/TabelaValorDataMapper.php';
      $this->setTabelaValorDataMapper(new TabelaArredondamento_Model_TabelaValorDataMapper());
    }
    return $this->_tabelaValorDataMapper;
  }

  /**
   * Finder para inst�ncias de TabelaArredondamento_Model_TabelaValor que tenham
   * refer�ncias a inst�ncia TabelaArredondamento_Model_Tabela passada como
   * par�metro.
   *
   * @param TabelaArredondamento_Model_Tabela $instance
   * @return array Um array de inst�ncias TabelaArredondamento_Model_TabelaValor
   */
  public function findTabelaValor(TabelaArredondamento_Model_Tabela $instance)
  {
    $where = array(
      'tabelaArredondamento' => $instance->id
    );
    return $this->getTabelaValorDataMapper()->findAll(array(), $where);
  }
}
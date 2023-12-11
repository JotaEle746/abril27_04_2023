function cambia() {

  var sel_departamento = document.getElementsByName("selectDepartamento")[0];
  var sel_provincia = document.getElementsByName("selectProvincia")[0];

  var opt_GEOLOGOS = new Array("NINGUNO", "GEÓLOGOS");
  var opt_GEOLOGOS_value = new Array("NINGUNO", "GEÓLOGOS");

  var opt_CIVILES = new Array("NINGUNO", "CIVIL");
  var opt_CIVILES_value = new Array("NINGUNO", "CIVIL");

  var opt_SISTEMAS = new Array("NINGUNO", "SISTEMAS", "EMPRESARIAL E INFORMATICA", "EMPRESARIAL Y DE SISTEMAS", "INDUSTRIAL", "SISTEMAS COMPUTACIONALES", "SISTEMAS E INFORMÁTICA");
  var opt_SISTEMAS_value = new Array("NINGUNO", "SISTEMAS", "EMPRESARIAL E INFORMATICA", "EMPRESARIAL Y DE SISTEMAS", "INDUSTRIAL", "SISTEMAS COMPUTACIONALES", "SISTEMAS E INFORMÁTICA");

  var opt_METALURGISTAS = new Array("NINGUNO", "METALURGISTA");
  var opt_METALURGISTAS_value = new Array("NINGUNO", "METALURGISTA");

  var opt_AMBIENTAL_Y_FORESTAL = new Array("NINGUNO", "AMBIENTAL", "AMBIENTAL Y FORESTAL", "FORESTAL", "SANITARIO", "SANITARIO Y AMBIENTAL");
  var opt_AMBIENTAL_Y_FORESTAL_value = new Array("NINGUNO", "AMBIENTAL", "AMBIENTAL Y FORESTAL", "FORESTAL", "SANITARIO", "SANITARIO Y AMBIENTAL");

  var opt_AGRICOLAS = new Array("NINGUNO", "AGRÍCOLA");
  var opt_AGRICOLAS_value = new Array("NINGUNO", "AGRÍCOLA");

  var opt_ECONOMISTAS = new Array("NINGUNO", "ECONOMÍA", "COMERCIAL");
  var opt_ECONOMISTAS_value = new Array("NINGUNO", "ECONOMÍA", "COMERCIAL");

  var opt_QUIMICOS = new Array("NINGUNO", "QUÍMICA");
  var opt_QUIMICOS_value = new Array("NINGUNO", "QUÍMICA");

  var opt_AGRONOMIA = new Array("NINGUNO", "AGRONOMÍA", "ZOOTECNIA");
  var opt_AGRONOMIA_value = new Array("NINGUNO", "AGRONOMÍA", "ZOOTECNIA");

  var opt_MECANICOS_Y_ELECTRICISTAS = new Array("NINGUNO", "ENERGÍAS RENOVABLES", "MECÁNICO ELECTRICISTA", "MECATRÓNICO");
  var opt_MECANICOS_Y_ELECTRICISTAS_value = new Array("NINGUNO", "ENERGÍAS RENOVABLES", "MECÁNICO ELECTRICISTA", "MECATRÓNICO");

  var opt_ELECTRONICOS = new Array("NINGUNO", "ELECTRÓNICO", "TELECOMUNICACIONES");
  var opt_ELECTRONICOS_value = new Array("NINGUNO", "ELECTRÓNICO", "TELECOMUNICACIONES");

  var opt_MINAS = new Array("NINGUNO", "DE MINAS", "SEGURIDAD Y GESTIÓN MINERA");
  var opt_MINAS_value = new Array("NINGUNO", "DE MINAS", "SEGURIDAD Y GESTIÓN MINERA");

  var opt_AGROINDUSTRIALES = new Array("NINGUNO", "AGROINDUSTRIAL", "ALIMENTOS", "INDUSTRIAS ALIMENTARIAS");
  var opt_AGROINDUSTRIALES_value = new Array("NINGUNO", "AGROINDUSTRIAL", "ALIMENTOS", "INDUSTRIAS ALIMENTARIAS");

  var opt_ESTADISTICOS = new Array("NINGUNO", "ESTADÍSTICA E INFORMATICA", "ESTADÍSTICA", "INFORMÁTICA");
  var opt_ESTADISTICOS_value = new Array("NINGUNO", "ESTADÍSTICA E INFORMATICA", "ESTADÍSTICA", "INFORMÁTICA");

  var opt_TOPOGRAFOS = new Array("NINGUNO", "	TOPÓGRAFO Y AGRIMENSOR");
  var opt_TOPOGRAFOS_value = new Array("NINGUNO", "	TOPÓGRAFO Y AGRIMENSOR");

  var opt_PESQUEROS = new Array("NINGUNO", "PESQUERÍA ACUICULTOR", "PESQUEROS");
  var opt_PESQUEROS_value = new Array("NINGUNO", "PESQUERÍA ACUICULTOR", "PESQUEROS");

  var cosa;

  var selectDepartamento = sel_departamento.options[sel_departamento.selectedIndex].value;


  if (selectDepartamento != 0) {
    mis_opts = eval("opt_" + selectDepartamento);
    mis_value = eval("opt_" + selectDepartamento + "_value");

    num_opts = mis_opts.length;

    sel_provincia.length = num_opts;

    for (i = 0; i < num_opts; i++) {
      sel_provincia.options[0].value = "NINGUNO";
      sel_provincia.options[0].text = "NINGUNO";


      sel_provincia.options[i].value = mis_value[i];
      sel_provincia.options[i].text = mis_opts[i];
    }


  }
  else {
    sel_provincia.length = 1;
    sel_provincia.options[0].value = "NINGUNO";
    sel_provincia.options[0].text = "NINGUNO";
  }
  sel_provincia.options[0].selected = true;
}
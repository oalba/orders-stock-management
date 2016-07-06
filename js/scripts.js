function seguromat($cod_mat,$mat){
//var con = document.getElementById('cod_con').value;
confirmar=confirm("Are you sure that you want to delete the material \"" + $mat + "\"?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        alert('The material will be deleted.');
        window.location='inc/delete_materials.php?cod_mat='+$cod_mat;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}

function seguroord($cod_ord){
//var con = document.getElementById('cod_con').value;
confirmar=confirm("Are you sure that you want to delete the order with the code \"" + $cod_ord + "\"?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        alert('The order will be deleted.');
        window.location='inc/delete_orders.php?cod_ord='+$cod_ord;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}

function seguropi($cod_piece,$piece,$plans){
//var con = document.getElementById('cod_con').value;
confirmar=confirm("Are you sure that you want to delete the piece \"" + $piece + "\"?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        alert('The piece will be deleted.');
        window.location='inc/delete_pieces.php?cod_piece='+$cod_piece+'&plans='+$plans;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}

function segurocli($cod_cli){
//var con = document.getElementById('cod_cli').value;
confirmar=confirm("Are you sure that you want to delete the client with the code \"" + $cod_cli + "\"?"); 
	if (confirmar) {
		// si pulsamos en aceptar
		alert('The client will be deleted.');
		window.location='inc/delete_clients.php?cod_cli='+$cod_cli;
		return true;
	}else{ 
		// si pulsamos en cancelar
		return false;
	}			
}

function seguroman($cod_man){
//var con = document.getElementById('cod_man').value;
confirmar=confirm("Are you sure that you want to delete the manager with the code \"" + $cod_man + "\"?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        alert('The manager will be deleted.');
        window.location='inc/delete_managers.php?cod_man='+$cod_man;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}

function segurosup($cod_sup){
//var con = document.getElementById('cod_sup').value;
confirmar=confirm("Are you sure that you want to delete the supplier with the code \"" + $cod_sup + "\"?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        alert('The supplier will be deleted.');
        window.location='inc/delete_suppliers.php?cod_sup='+$cod_sup;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}

function seguroOrdPie($cod_piece,$cod_ord){
    //var con = document.getElementById('cod_con').value;
    confirmar=confirm("Are you sure that you want to delete the piece \"" + $cod_piece + "\" from the order \"" + $cod_ord + "\"?");
    if (confirmar) {
        // si pulsamos en aceptar
        alert('The piece will be deleted from the order.');
        window.location='inc/delete_ord_piece.php?cod_piece='+$cod_piece+'&cod_ord='+$cod_ord;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}

function seguroPieMat($cod_mat,$cod_piece){
    //var con = document.getElementById('cod_con').value;
    confirmar=confirm("Are you sure that you want to delete the material \"" + $cod_mat + "\" from the piece \"" + $cod_piece + "\"?");
    if (confirmar) {
        // si pulsamos en aceptar
        alert('The material will be deleted from the piece.');
        window.location='inc/delete_piece_mat.php?cod_piece='+$cod_piece+'&cod_mat='+$cod_mat;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}


function changePie(obj,nue) {
    var selectBox = obj;
    var nue = nue;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    document.getElementById("cod_piece"+nue).value = selected;
}

function changeMat(obj,nue) {
    var selectBox = obj;
    var nue = nue;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    document.getElementById("cod_mat"+nue).value = selected;
}

function changeCli(obj) {
    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    document.getElementById("cod_cli").value = selected;
}

function changeMan(obj) {
    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    document.getElementById("cod_man").value = selected;
}

/*function changeMat(obj) {
    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    document.getElementById("cod_material").value = selected;
}*/



window.onscroll = function() {
    var top = document.getElementById("go-top");
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        top.style.display = "block";
    } else {
        top.style.display = "none";
    }
}







/*function changeCli(obj) {
    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var sele = selected.split("|");
    var textarea = document.getElementById("cliente1");
    var text = document.getElementById("cif1");

    if(sele[0] === "1"){
        textarea.style.display = "block";
        text.style.display = "none";
    }else if (sele[0] === ""){
        textarea.style.display = "none";
        text.style.display = "none";
    }else{
        textarea.style.display = "none";
        text.style.display = "block";
    }
    document.getElementById("cif1").value = sele[1];
}

function changeCliman(obj) {
    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var textarea = document.getElementById("cliente1");
    var text = document.getElementById("cif1");

    if(selected === "1"){
        textarea.style.display = "block";
        text.style.display = "none";
    }else if (selected === ""){
        textarea.style.display = "none";
        text.style.display = "none";
    }else{
        textarea.style.display = "none";
        text.style.display = "block";
    }
    document.getElementById("cif1").value = selected;
}

function changeClim(obj,ver) {
    var selectBox = obj;
    var version = ver;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var sele = selected.split("|");
    var textarea = document.getElementById("cliente1"+version);
    var text = document.getElementById("cif1"+version);

    if(sele[0] === "1"){
        textarea.style.display = "block";
        text.style.display = "none";
    }else if (sele[0] === ""){
        textarea.style.display = "none";
        text.style.display = "none";
    }else{
        textarea.style.display = "none";
        text.style.display = "block";
    }
    document.getElementById("cif1"+version).value = sele[1];
}

function changeConIndem(obj,ver) {
    var selectBox = obj;
    var version = ver;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var textarea = document.getElementById("text_area"+version);

    if(selected === "1"){
        textarea.style.display = "block";
    }
    else{
        textarea.style.display = "none";
    }
} */

/*function seguroconce($con){
confirmar=confirm("¿Seguro que quiere eliminar el concepto: " + $con + "?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        alert('El concepto será eliminado.');
        window.location='inc/delete_conce.php?concepto='+$con;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }
}*/
/*function seguroConFac($con,$fac,$ord){
    //var con = document.getElementById('cod_con').value;
    confirmar=confirm("¿Seguro que desea eliminar el concepto \"" + $con + "\" de la factura \"" + $fac + "\"?");
    if (confirmar) {
        // si pulsamos en aceptar
        alert('El concepto será eliminado.');
        window.location='inc/delete_con_fac.php?concepto='+$con+'&cod_fac='+$fac+'&orden='+$ord;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}

function changeNumPan(obj,num,pan) {
    var selectBox = obj;
    var num = num;
    var pan = pan;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var sele = selected.split("|");
    var textarea = document.getElementById("text_area"+num);

    if(sele[0] === "1"){
        textarea.style.display = "block";
        document.getElementById("precio"+num).value = pan;
    }
    else{
        textarea.style.display = "none";
        document.getElementById("precio"+num).value = sele[1];
    }
}

function changeConInde(obj) {
    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var textarea = document.getElementById("text_area");

    if(selected === "1"){
        textarea.style.display = "block";
    }
    else{
        textarea.style.display = "none";
    }
} 

function seguroFac($cod_fac){
//var con = document.getElementById('cod_fac').value;
confirmar=confirm("¿Seguro que quiere eliminar la factura con el código \"" + $cod_fac + "\"?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        alert('La factura será eliminada.');
        window.location='inc/delete_factura.php?cod_fac='+$cod_fac;
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}*/
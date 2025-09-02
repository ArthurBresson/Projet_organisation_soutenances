<?php

// biliotheque fonctions formulaire avec bootstrap
// --------------------------------------------------
// form_begin
// --------------------------------------------------

function form_begin($class, $method, $action) {
    echo ("\n<!-- ============================================== -->\n");
    echo ("<!-- form_begin : $class $method $action) -->\n");
    printf("<form class='%s' method='%s' action='%s'>\n", $class, $method, $action);
}

// --------------------------------------------------
// form_input_text
// --------------------------------------------------

function form_input_text($label, $name, $size, $value) {
    echo ("\n<!-- form_input_text : $label $name $size $value -->\n");
    echo ("  <p>\n");

    echo ("<div class='form-group col-6'>");
    echo (" <label for='$label' class=' fw-bold'>$label</label>");
    echo (" <input type='text' class='form-control' name='$name' size='$size' value='$value' >");
    echo ("</div>");
    echo '<br/>';
}


// --------------------------------------------------
// form_input_password
// --------------------------------------------------

function form_input_password($label, $name, $size, $value) {
    echo ("\n<!-- form_input_paswword : $label $name $size $value -->\n");
    echo ("  <p>\n");

    echo ("<div class='form-group col-6'>");
    echo (" <label for='$label' class=' fw-bold'>$label</label>");
    echo (" <input type='password' class='form-control' name='$name' size='$size' value='$value' >");
    echo ("</div>");
    echo '<br/>';
}


// --------------------------------------------------
// form_input_hidden
// --------------------------------------------------

function form_input_hidden($name, $value) {
    echo ("\n<!-- form_input_hidden : $name $value -->\n");
    echo (" <input type='hidden' name='$name' value='$value'>");
}

// =========================
// form_select
// =========================

// Parametre $label    : permet un affichage (balise label)
// Parametre $name     : attribut pour identifier le composant du formulaire
// Parametre $multiple : si cet attribut n'est pas vide alors sélection multiple possible
// Parametre $size     : attribut size de la balise select
// Parametre $liste    : un liste d'options. Vous utiliserez un foreach pour générer les balises option

function form_select($label, $name, $multiple, $size, $liste) {
    echo '<label for="' . $name . '" class="form-label"><b>' . $label . '</b></label><br>';
    echo '<select name="' . $name . '" class="form-select w-50" size="' . $size . '" ' . $multiple . '>';
    foreach ($liste as $value) {
        echo '<option value="' . $value . '">' . $value . '</option>';
    }
    echo '</select></br>';
}


function form_checkbox($label, $name, $value) {
    echo '<div class="form-check">';
    echo '<input class="form-check-input" type="checkbox" id="' . $name . '" name="' . $name . '" value="' . $value . '">';
    echo '<label class="form-check-label" for="' . $name . '">' . $label . '</label><br>';
    echo '</div>';
}

function form_datalist_projet($label, $name, $liste) {
    echo '<div class="mb-3">'; // Margin bottom for spacing
    echo '<label for="' . $name . '" class="form-label"><b>' . $label . '</b></label>';
    echo '<select class="form-select " name="' . $name . '" id="' . $name . '">';
    
    foreach ($liste as $key => $value) {
        echo '<option value="' . $value['label'] . '">' . $value['label'] . '</option>';
    }
    echo '</select>';
    echo '</div></br>';
}


function form_date($label, $name, $value = '') {
    echo '<label for="' . $name . '" class="form-label"><b>' . $label . '</b></label><br>';
    echo '<input type="date" class="form-control" id="' . $name . '" name="' . $name . '" value="' . $value . '">';
    echo '<br>';
}

function form_time($label, $name, $value = '') {
    echo '<label for="' . $name . '" class="form-label"><b>' . $label . '</b></label><br>';
    echo '<input type="time" class="form-control" id="' . $name . '" name="' . $name . '" value="' . $value . '">';
    echo '<br>';
}

function form_input_number($label,$name){
    echo'<label for="'.$label.'">'.$label.'</label><br>';
    echo'<input type="number" id="'.$name.'" name="'.$name.'" min="1" max="10" step="1" value="1">';
    echo '<br><br>';
}



// =========================

function form_input_reset($value) {
    echo '<input type="reset" class="btn btn-jaune m-1" value="' . $value . '">';
}

// =========================

function form_input_submit($value) {
    echo '<input type="submit" value="' . $value . '" class="btn btn-jaune m-1">';
}

// =========================


function form_end() {
    echo '</form>';
}

// =========================

?>



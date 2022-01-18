<?php

//$_SESSION['nivel']=="1"
function getMenuAdmin(){
    $resultado = "
        <nav class='menu' id='menu'>
            <ul>
                <li class='one'><a href='libros.php' title='inicio' class='lisLib'>Libros</a></li>
                <li><a href='contadores.php' title='contadores' class='lisCon'>Contadores</a></li>
                <li><a href='clientes.php' title='clientes' class='lisCli'>Clientes</a></li>
                <li><a href='inventario.php' title='inventario' class='lisInv'>Inventario</a></li>
                <li class='ultimo'><a href='usuarios.php' title='user' class='lisUsu'>Usuarios</a></li>
            </ul>
    ";
    return $resultado;

}
//$_SESSION['nivel']=="2"
function getMenuUser(){
    $resultado = "
        <nav class='menu'>
            <ul>
                <li><a href='librosUs.php' title='inicio'>Libros</a></li>
                <li><a href='clientesUs.php' title='clientes'>Clientes</a></li>
                
            </ul>
    ";
    return $resultado;


}

function dabase($indicio){
/*
    switch ($indicio) {
        case 'libros':
            $resultado = "
            <nav class='menu'>
            <ul>
                <li><a href='db/lib/insertar.php' title='insertar'>Insertar</a></li>
                <li><a href='db/lib/modificar.php' title='modificar'>Modificar</a></li>
                <li><a href='db/lib/eliminar.php' title='eliminar'>Eliminar</a></li>
                <li><a href='libros.php' title='tabla'>Tabla</a></li>
                
            </ul>
            ";
            return $resultado;
            break;
            case 'contadores':
                $resultado = "
                <nav class='menu'>
                <ul>
                    <li><a href='db/cont/insertar.php' title='insertar'>Insertar</a></li>
                    <li><a href='db/cont/modificar.php' title='modificar'>Modificar</a></li>
                    <li><a href='db/cont/eliminar.php' title='eliminar'>Eliminar</a></li>
                    
                    
                </ul>
                ";
                return $resultado;
                break;
                case 'cliente':
                    $resultado = "
                    <nav class='menu'>
                    <ul>
                        <li><a href='db/cli/insertar.php' title='insertar'>Insertar</a></li>
                        <li><a href='db/cli/modificar.php' title='modificar'>Modificar</a></li>
                        <li><a href='db/cli/eliminar.php' title='eliminar'>Eliminar</a></li>
                        
                        
                    </ul>
                    ";
                    return $resultado;
                    break;
                    case 'inventario':
                        $resultado = "
                        <nav class='menu'>
                        <ul>
                            <li><a href='db/inv/insertar.php' title='insertar'>Insertar</a></li>
                            <li><a href='db/inv/modificar.php' title='modificar'>Modificar</a></li>
                            <li><a href='db/inv/eliminar.php' title='eliminar'>Eliminar</a></li>
                            
                            
                        </ul>
                        ";
                        return $resultado;
                        break;
                        case 'usuarios':
                            $resultado = "
                            <nav class='menu'>
                            <ul>
                                <li><a href='db/us/insertar.php' title='insertar'>Insertar</a></li>
                                <li><a href='db/us/modificar.php' title='modificar'>Modificar</a></li>
                                <li><a href='db/us/eliminar.php' title='eliminar'>Eliminar</a></li>
                                
                                
                            </ul>
                            ";
                            return $resultado;
                            break;
        
        default:
           echo "error";
            break;
    }
    
*/
if ($indicio == 'clientes') {
    $resultado = "
    <!--<form class='navbar-form navbar-left'>
        <div class='input-group'>
            <input type='text' class='form-control' placeholder='Buscar'/>
            <span class='input-group-btn'>
            <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-search'></span></button></span>
        </div>
    </form>-->
    <br>
    <nav class='menu menu2'>
    <ul>
        <!--<li><a href='db/cli/insertar.php' title='insertar'>Insertar</a></li>
        <li><a href='db/cli/modificar.php' title='modificar'>Modificar</a></li>-->
           
    </ul> <br>
    ";
}elseif ($indicio == 'usuarios') {
    $resultado = "
    <!--<form class='navbar-form navbar-left'>
    <div class='input-group'>
        <input type='text' class='form-control' placeholder='Buscar' />
        <span class='input-group-btn'>
            <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-search'></span></button>
        </span>
    </div>
</form>-->
<br>
                            <nav class='menu menu2'>
                            <ul>
<!--                                <li><a href='db/us/insertar.php' title='insertar'>Insertar</a></li>
                                <li><a href='db/us/modificar.php' title='modificar'>Modificar</a></li>-->
                                
                                
                                
                            </ul> <br>
                           
                            ";
    
}elseif ($indicio == 'contadores') {
    $resultado = "
    <!--<form class='navbar-form navbar-left'>
                <div class='input-group'>
                    <input type='text' class='form-control' placeholder='Buscar' />
                    <span class='input-group-btn'>
                        <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-search'></span></button>
                    </span>
                </div>
            </form>-->
            <br>
                <nav class='menu menu2'>
                <ul>
                <!--    <li><a href='db/cont/insertar.php' title='insertar'>Insertar</a></li>
                    <li><a href='db/cont/modificar.php' title='modificar'>Modificar</a></li>
                    -->
                    
                    
                </ul> <br>
                
                ";
    
        
    
}elseif ($indicio == 'libros') {
    $resultado = "
    <!--<form class='navbar-form navbar-left'>
                <div class='input-group'>
                    <input type='text' class='form-control' placeholder='Buscar' />
                    <span class='input-group-btn'>
                        <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-search'></span></button>
                    </span>
                </div>
            </form>-->
            <br>
            <nav class='menu2'>
            <ul>
                <!--<li><a href='db/lib/insertar.php' title='insertar'>Insertar</a></li>
                <li><a href='db/lib/modificar.php' title='modificar'>Modificar</a></li>-->
                
                
            </ul> <br>
            
            ";
    
}elseif ($indicio == 'inventario' ) {
    $resultado = "
    <!--<form class='navbar-form navbar-left'>
                <div class='input-group'>
                    <input type='text' class='form-control' placeholder='Buscar' />
                    <span class='input-group-btn'>
                        <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-search'></span></button>
                    </span>
                </div>-->
            </form>
            <br>
                        <nav class='menu menu2'>
                                <ul>
        <!--                    <li><a href='db/inv/insertar.php' title='insertar'>Insertar</a></li>
                            <li><a href='db/inv/modificar.php' title='modificar'>Modificar</a></li>-->
                            
                            
                            
                        </ul> <br>
                        
                        ";

}
return $resultado;
}


?>
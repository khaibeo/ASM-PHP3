<?php 
function currencyFormat($value){
    return number_format($value, 0, ',', '.') . ' đ';
}
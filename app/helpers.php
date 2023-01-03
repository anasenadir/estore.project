<?php

if(!function_exists('unit_name')){
    function unit_name(int $unit_id){
        if($unit_id == 1){
            return 'للمتر ';
        }elseif($unit_id == 2){
            return 'للوحدة';
        }

        return '';
    }
}


if(!function_exists('pyment_type')){
    function pyment_type(int $type){
        if($type == 1){
            return ' كاش';
        }elseif($type == 2){
            return 'شيك';
        }
        return '';
    }
}


if(!function_exists('pyment_status')){
    function pyment_status(int $type){
        if($type == 1){
            return 'مدفوع';
        }elseif($type == 0){
            return 'غير مدفوع';
        }
        return '';
    }
}

if(!function_exists('purchases_received')){
    function purchases_received(int $type){
        if($type == 0){
            return 'لازالت قيد الشراء';
        }
        elseif($type == 1){
            return 'تمت إضافتها بنجاح';
        }

        return "";
    }
}
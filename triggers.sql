use "estore.project";

#=>product
#id
#quatity
select * from sele_details where sele_id = 13;
select * from products;
select * from seles;

update seles set client_id= 2 where id = 12;
#product_id quantity
delimiter //
create trigger add_deleted_quantity_to_stock after delete on sele_details for each row
begin 
		update products set quatity = quatity + old.quantity where id = old.product_id;
end //
delimiter ;



delimiter //
create trigger decrease_quantity_when_sale_it after insert on sele_details for each row
begin 
	update products set quatity = quatity - new.quantity where id = new.product_id;
end //
delimiter ;

#select * from sele_details;
-- drop trigger if exists deleting_old_details;
-- delimiter //
-- create trigger deleting_old_details before update on seles for each row
-- begin 
-- 	delete from sele_details where sele_id = old.id;
-- end //
-- delimiter ;




-- delimiter // 
-- create trigger paidAmount_and_AmountShoudPay after insert on sele_details for each row
-- begin 
-- 	declare totalAmountShoudPay decimal(8,2);
--     declare totalPaidAmount decimal(8,2);
--     select sum(quantity * product_price) into totalAmountShoudPay from sele_details where sele_id = new.sele_id;
--     select sum(pyment_amount)  into totalPaidAmount from sele_reciepts where sele_id =  new.sele_id ;
--     if totalPaidAmount > totalAmountShoudPay then
-- 		select * from sele_reciepts;
--         select * from sele_details;
--         delete from sele_reciepts where sele_id =  new.sele_id;
--         
--     end if ;
-- end // 
-- delimiter ;

delimiter // 
create trigger changePaymentStatus after insert on sele_reciepts for each row
begin 
	declare totalAmountShoudPay decimal(8,2);
    declare totalPaidAmount decimal(8,2);
    select sum(quantity * product_price) into totalAmountShoudPay from sele_details where sele_id = new.sele_id;
    select sum(pyment_amount)  into totalPaidAmount from sele_reciepts where sele_id =  new.sele_id ;
    if totalPaidAmount = totalAmountShoudPay then
        update seles set pyment_status = 1 where id = new.sele_id;
	else
		update seles set pyment_status = 0 where id = new.sele_id;
    end if ;
end // 
delimiter ;

delimiter //
create trigger delete_All_Data_Of_Sele before delete on seles for each row
begin 
	delete from sele_details where sele_id = old.id;
    delete from sele_reciepts where sele_id = old.id;
end //
delimiter ;



-- delete the pricing details befete delete the pricing invoice 
drop trigger if exists delete_pricing_details;
delimiter //
create trigger delete_pricing_details before delete on pricings for each row
begin
	delete from pricing_details where pricing_id = old.id;
end //
delimiter ;

select * from "Worker" inner join "Labor_contract" on "Worker"."Work_ID"="Labor_contract"."Work_ID" order by "Worker"."FIO"

select * from "Payment_order" where "Status" = 'Y' and "Date" = '12/01'
select * from "Material" where "Mat_ID" = '1' or "Mat_ID" = '2'
select * from "Material" where "Mat_ID" = '1' and "Serv_ID" = '1'

select * from "Payment_order" where "Date" between '10/01/2020' and '10/02/2020'
select * from "Payment_order" where "Date" between '10/02/2020' and '10/06/2020'
select * from "Payment_order" where "Date" between '10/01/2020' and '10/06/2020'

select Reverse("Name") from "Client";

select("phone") from "Client" where "Name" = (select "Name" from "Request" where "Req_ID" = '1')
select("FIO") from "Worker" where "Work_ID" = (select "Work_ID" from "Labor_contract" where "Req_ID" = '4')

select count(*) from "Payment_order" where "Status" = 'N'

select count(*) from "Service" group by "Total cost" having "Total cost" = '10.000'

select * from "Service" where "Serv_ID" = ANY(array[3,4])

select "Serv_ID" from "Material" intersect select "Serv_ID" from "Price_list"

select * from "Client" inner join "Request" on "Client"."Name"="Request"."Name"

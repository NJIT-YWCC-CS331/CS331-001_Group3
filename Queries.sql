--SQL QUERIES

--QUERY 1
SELECT  Placer_ID, COUNT (Ord_ID) AS Total_Orders
FROM  STORE_ORDER
GROUP BY  Placer_ID;


--QUERY 2
SELECT  ReviewedID, ROUND ( AVG ( Rating ), 2) AS Average_Rating
FROM   REVIEW
GROUP BY   ReviewedID
HAVING  COUNT ( ReviewedID )  >  1;


--QUERY 3
SELECT  ISBN, Title, Stk_Quant, Price
FROM  BOOK
WHERE  Price  >  ALL  (
				SELECT  Price
				FROM   BOOK
				WHERE   Book_mgrID  =  'ADM005');


--QUERY 4
SELECT  Cust_name, Cust_address, Cust_phone_no
FROM  CUSTOMER
WHERE  Cust_ID IN  ( 
          SELECT  Placer_ID
          FROM  STORE_ORDER
          WHERE  Ship_Status  =  'Processing'  );

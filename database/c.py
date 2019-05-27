#Zakary Worman

import random
import string

def make_order():
    sqlFile = "ins_order.sql"
    sqlData = open(sqlFile, 'w', encoding='utf-8')
    for count in range(200):
        #employee_id
        sqlData.write('INSERT INTO c_order VALUES(' + str(random.randint(0,10)) + ',')
        #customer_num
        sqlData.write(str(random.randint(0,199)) + ',')
        #menu_id
        sqlData.write(str(random.randint(0,64)) + ',')
        #order_id
        sqlData.write(str(2000+count) + ',')
        #date
        sqlData.write('to_date(\'' + str(random.randint(1,12))  + '/' + str(random.randint(1,20)) + '/' 
                + str(random.randint(2000, 2019)) + '\', ' + '\'mm/dd/yyyy\'));\n')
    for count in range(100):
        #employee_id
        sqlData.write('INSERT INTO c_order VALUES(' + str(random.randint(0,30)) + ',')
        #customer_num
        sqlData.write(str(random.randint(0,199)) + ',')
        #menu_id
        sqlData.write(str(random.randint(0,64)) + ',')
        #order_id
        sqlData.write(str(2200+count) + ',')
        #date
        sqlData.write('to_date(\'' + str(random.randint(1,12))  + '/' + str(random.randint(1,20)) + '/' 
                + str(random.randint(2000, 2019)) + '\', ' + '\'mm/dd/yyyy\'));\n')
    for count in range(500):
        #employee_id
        sqlData.write('INSERT INTO c_order VALUES(' + str(random.randint(0,49)) + ',')
        #customer_num
        sqlData.write(str(random.randint(0,199)) + ',')
        #menu_id
        sqlData.write(str(random.randint(0,64)) + ',')
        #order_id
        sqlData.write(str(2300+count) + ',')
        #date
        sqlData.write('to_date(\'' + str(random.randint(1,12))  + '/' + str(random.randint(1,20)) + '/' 
                + str(random.randint(2000, 2019)) + '\', ' + '\'mm/dd/yyyy\'));\n')
    for count in range(100):
        #employee_id
        sqlData.write('INSERT INTO c_order VALUES(' + str(random.randint(0,1)) + ',')
        #customer_num
        sqlData.write(str(random.randint(0,199)) + ',')
        #menu_id
        sqlData.write(str(random.randint(0,64)) + ',')
        #order_id
        sqlData.write(str(2800+count) + ',')
        #date
        sqlData.write('to_date(\'' + str(random.randint(1,12))  + '/' + str(random.randint(1,20)) + '/' 
                + str(random.randint(2000, 2019)) + '\', ' + '\'mm/dd/yyyy\'));\n')
    sqlData.write('commit;')
    sqlData.close()
make_order()

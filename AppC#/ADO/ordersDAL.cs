using DAL;
using DTO;
using Mysqlx.Crud;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ADO
{
    public class ordersDAL
    {
        DBConnect dbconn = new DBConnect();
        public ordersDAL()
        {

        }
        public bool new_orders(int customerid, int employeeid, double total)
        {
            try
            {
                string insertString = "INSERT INTO `orders`(`CustomerId`, `EmployeeId`, `Total`) VALUES('" + customerid + "', '" + employeeid + "', '" + total + "')";
                int kq = dbconn.execute_NonQuery(insertString);
                if (kq > 0)
                    return true;
            }
            catch
            {
                return false;
            }
            return false;
        }

        public List<orders> Last_Id()
        {
            List<orders> List_tt = new List<orders>();
            string selectstring = "SELECT Id FROM `orders` ORDER BY Id DESC LIMIT 1";
            DataTable dt_tt = dbconn.getDatatable(selectstring, "dbo.orders");
            foreach (DataRow item in dt_tt.Rows)
            {
                orders san = new orders(item);
                List_tt.Add(san);
            }
            return List_tt;
        }

        public DataTable loadhoadon()
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT orders.`Id`, orders.`CustomerId`, orders.`EmployeeId`, orders.`Date`, orders.`Total`, employee.Name as 'TenNV', customer.Name as 'TenKH', customer.Phome  FROM `orders`, customer, employee WHERE orders.CustomerId = customer.Id and orders.EmployeeId = employee.Id ORDER BY orders.`Id` DESC";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.hoadon");
            return dt_kh;
        }
        public DataTable timkiemhoadon(int id)
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT orders.`Id`, orders.`CustomerId`, orders.`EmployeeId`, orders.`Date`, orders.`Total`, employee.Name as 'TenNV', customer.Name as 'TenKH', customer.Phome  FROM `orders`, customer, employee WHERE orders.CustomerId = customer.Id and orders.EmployeeId = employee.Id AND orders.Id LIKE '%" + id + "%'";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.hoadon");
            return dt_kh;
        }
        public DataTable HD_Thang(int year)
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT YEAR(orders.`Date`) AS Year, MONTH(orders.`Date`) AS Month, SUM(Total) AS Total FROM orders WHERE YEAR(orders.`Date`) = " + year + " GROUP BY YEAR(orders.`Date`), MONTH(orders.`Date`)";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.a");
            return dt_kh;
        }
        public DataTable loadhoadononline()
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT orders.`Id`, orders.`CustomerId`, orders.`Date`, orders.`Total`, customer.Name as 'TenKH', customer.Phome  FROM `orders`, customer WHERE orders.CustomerId = customer.Id and orders.EmployeeId IS NULL ORDER BY orders.`Id` DESC";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.hoadon");
            return dt_kh;
        }
        public DataTable loadHd_Online()
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT orders.Id, customer.Name, orders.Date , orders.Total FROM orders,customer WHERE orders.CustomerId = customer.Id AND orders.EmployeeId IS NULL";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.online");
            return dt_kh;
        }

        public bool capnhatnhanvien(int orderid, int empid)
        {
            try
            {
                string insertString = "UPDATE `orders` SET `EmployeeId`='" + empid + "' WHERE Id = '" + orderid + "'";
                int kq = dbconn.execute_NonQuery(insertString);
                if (kq > 0)
                    return true;
            }
            catch
            {
                return false;
            }
            return false;
        }
    }
}

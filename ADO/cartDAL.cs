using DAL;
using DTO;
using MySql.Data.MySqlClient;
using Mysqlx.Crud;
using System;
using System.Collections.Generic;
using System.Data;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml.Linq;

namespace ADO
{
    public class cartDAL
    {
        DBConnect dbconn = new DBConnect();
        public cartDAL()
        {

        }
        public bool addcart(int customerid, int productid, string size, int quantity)
        {
            try
            {
                
                string insertString = "INSERT INTO `cart`(`CustomerId`, `ProductId`, `Size`, `Quantity`) VALUES('" + customerid + "', '" + productid + "', '" + size + "', '" + quantity + "')";
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

        public bool capnhatsoluong(int productid, int quantity, int customerid, string size)
        {
            try
            {
                string insertString = "UPDATE `cart` SET `Quantity`='" + quantity + "' WHERE ProductId = '" + productid + "' and CustomerId = '" + customerid + "' and Size = '" + size + "'";
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

        public bool XoaSPCart(int productid, int customerid, string size)
        {
            try
            {

                string insertString = "DELETE FROM `cart` WHERE ProductId = '" + productid + "' and CustomerId = '" + customerid + "' and Size = '" + size + "'";
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
        public bool EmptyCart(int customerid)
        {
            try
            {
                string insertString = "DELETE FROM `cart` WHERE CustomerId = '" + customerid + "'";
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


        public DataTable loadcart(int customerid)
        {
            DataTable dt_kh = new DataTable();
            dt_kh.Clear();
            string sqlselect = "SELECT cart.ProductId, products.Name , cart.`Quantity`, cart.`Size`, products.Price FROM `cart`, products, customer " +
                "WHERE cart.ProductId = products.Id AND cart.CustomerId = customer.Id AND cart.CustomerId = '" + customerid + "'";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.cart");
            return dt_kh;
        }

        public bool KT_sanpham(int id)
        {
            dbconn.openConnecttion();
            string selectstring = "SELECT products.Name , cart.`Quantity`, cart.`Price` FROM `cart`, products WHERE cart.ProductId = products.Id and cart.ProductId = '" + id + "'";
            MySqlDataReader kt = dbconn.execute_Reader(selectstring);
            if (kt.HasRows)
            {
                kt.Close();
                dbconn.closedConnecttion();
                return true;
            }
            else
            {
                kt.Close();
                dbconn.closedConnecttion();
                return false;
            }
        }

        public List<cart> Thongtin1sptrongcart(int productid, string size, int customerid)
        {
            List<cart> List_tt = new List<cart>();
            string selectstring = "select cart.ProductId, cart.Size, cart.Quantity from cart, customer where cart.CustomerId = customer.Id AND cart.CustomerId = '" + customerid + "' AND ProductId = '" + productid + "' AND Size = '" + size + "'";
            DataTable dt_tt = dbconn.getDatatable(selectstring, "dbo.cart");
            foreach (DataRow item in dt_tt.Rows)
            {
                cart san = new cart(item);
                List_tt.Add(san);
            }
            return List_tt;
        }

        public List<cart> SpTheoKH(int customerid)
        {
            List<cart> List_tt = new List<cart>();
            string selectstring = "select cart.ProductId, cart.Size, cart.Quantity, products.Price from cart, customer, products where cart.CustomerId = customer.Id AND cart.CustomerId = '" + customerid + "' AND cart.ProductId = products.Id ";
            DataTable dt_tt = dbconn.getDatatable(selectstring, "dbo.cart");
            foreach (DataRow item in dt_tt.Rows)
            {
                cart san = new cart(item);
                List_tt.Add(san);
            }
            return List_tt;
        }


    }
}

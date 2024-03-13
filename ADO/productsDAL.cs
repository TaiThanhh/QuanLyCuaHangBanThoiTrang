using DAL;
using DTO;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Threading.Tasks;

namespace ADO
{
    public class productsDAL
    {
        DBConnect dbconn = new DBConnect();
        public productsDAL()
        {

        }

        public DataTable loadSanPham()
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT products.Id, products.Name, products.Description, products.Price, products.Image, category.Categry_Name \r\nFROM `products`, category \r\nWHERE products.CategoryId = category.Id ORDER BY products.Id DESC";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.products");
            return dt_kh;
        }
        public DataTable loadSanPhamTheoTen(string tensp)
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT products.Id, products.Name, products.Description, products.Price, products.Image, category.Categry_Name FROM `products`, category WHERE products.CategoryId = category.Id AND products.Name LIKE '%" + tensp + "%'";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.products");
            return dt_kh;
        }
        public List<products> SpTheoKH(int customerid)
        {
            List<products> List_tt = new List<products>();
            string selectstring = "select products.Price from cart, customer, products where cart.CustomerId = customer.Id AND cart.CustomerId = '" + customerid + "' AND cart.ProductId = products.Id ";
            DataTable dt_tt = dbconn.getDatatable(selectstring, "dbo.products");
            foreach (DataRow item in dt_tt.Rows)
            {
                products san = new products(item);
                List_tt.Add(san);
            }
            return List_tt;
        }

        public bool KT_hinhanh(string image)
        {
            dbconn.openConnecttion();
            string selectstring = "SELECT * FROM `products` WHERE Image = '" + image + "'";
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

        public bool new_product(string Name, string Description, double Price, string Image, int CategoryId)
        {
            try
            {
                string insertString = "INSERT INTO `products`(`Name`, `Description`, `Price`, `Image`, `CategoryId`, `Active`) VALUES('" + Name + "', '" + Description + "', '" + Price + "', '" + Image + "', '" + CategoryId + "',1)";
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
        public bool edit_product(string Name, string Description, double Price, string Image, int CategoryId, int id)
        {
            try
            {
                string insertString = "UPDATE `products` SET `Name`='" + Name + "',`Description`='" + Description + "',`Price`=" + Price + ",`Image`='" + Image + "',`CategoryId`=" + CategoryId + " WHERE Id = '" + id + "'";
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

        public bool delete_product(int id)
        {
            try
            {
                string insertString = "DELETE FROM `products` WHERE Id = " + id + "";
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

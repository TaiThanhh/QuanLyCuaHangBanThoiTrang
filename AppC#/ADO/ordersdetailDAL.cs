using DAL;
using DTO;
using Mysqlx.Crud;
using System;
using System.Collections.Generic;
using System.Data;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ADO
{
    public class ordersdetailDAL
    {
        DBConnect dbconn = new DBConnect();
        public ordersdetailDAL()
        {

        }
        public bool new_ordersdetail(int ordersid, int productid, string size, double price, int quantity)
        {
            try
            {
                string insertString = "INSERT INTO `ordersdetail`(`OrdersId`, `ProductsId`, `Size`, `Price`, `Quantity`) VALUES('" + ordersid + "', '" + productid + "', '" + size + "', '" + price + "', '" + quantity + "')";
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
        
        public DataTable loadchitiethoadon(int ordersid)
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT ordersdetail.`Id`, `OrdersId`, `ProductsId`, products.Name, `Size`, ordersdetail.`Price`, `Quantity` FROM `ordersdetail`, products WHERE ordersdetail.ProductsId = products.Id AND OrdersId = " + ordersid + "";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.chitiet");
            return dt_kh;
        }
        public DataTable load_ChiTiet_Online(int ordersid)
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT products.Name, ordersdetail.Size ,ordersdetail.Quantity,ordersdetail.Price from ordersdetail, products,orders WHERE ordersdetail.ProductsId = products.Id and ordersdetail.OrdersId= orders.Id AND ordersdetail.OrdersId = " + ordersid + "";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.chitietonline");
            return dt_kh;
        }
    }
}

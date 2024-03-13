using ADO;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BLL
{
    public class ordersdetailBLL
    {
        ordersdetailDAL ordersdetailDAL = new ordersdetailDAL();
        public ordersdetailBLL()
        {

        }

        public bool new_ordersdetail(int ordersid, int productid, string size, double price, int quantity)
        {
            return ordersdetailDAL.new_ordersdetail(ordersid, productid, size, price, quantity);
        }
        
        public DataTable loadchitiethoadon(int ordersid)
        {
            return ordersdetailDAL.loadchitiethoadon(ordersid);
        }
        public DataTable load_ChiTiet_Online(int ordersid)
        {
            return ordersdetailDAL.load_ChiTiet_Online(ordersid);
        }
    }
}

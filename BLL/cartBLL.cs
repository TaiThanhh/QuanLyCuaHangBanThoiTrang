using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using ADO;
using DAL;
using DTO;

namespace BLL
{
    public class cartBLL
    {
        cartDAL cartDAL = new cartDAL();
        public cartBLL()
        {

        }

        public bool addcart(int customerid, int productid, string size, int quantity)
        {
            return cartDAL.addcart(customerid, productid, size, quantity);
        }
        public bool capnhatsoluong(int productid, int quantity, int customerid, string size)
        {
            return cartDAL.capnhatsoluong(productid, quantity, customerid, size);
        }
        public bool XoaSPCart(int productid, int customerid, string size)
        {
            return cartDAL.XoaSPCart(productid, customerid, size);
        }
        public bool EmptyCart(int customerid)
        {
            return cartDAL.EmptyCart(customerid);
        }

        public DataTable loadcart(int customerid)
        {
            return cartDAL.loadcart(customerid);
        }

        public bool KT_sanpham(int id)
        {
            return cartDAL.KT_sanpham(id);
        }

        public List<cart> Thongtin1sptrongcart(int productid, string size, int customerid)
        {
            return cartDAL.Thongtin1sptrongcart(productid, size, customerid);
        }

        public List<cart> SpTheoKH(int customerid)
        {
            return cartDAL.SpTheoKH(customerid);
        }
    }
}

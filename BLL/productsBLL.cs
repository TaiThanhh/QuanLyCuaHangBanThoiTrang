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
    public class productsBLL
    {
        productsDAL productsDAL = new productsDAL();
        public productsBLL()
        {

        }
        public DataTable loadSanPham()
        {
            return productsDAL.loadSanPham();
        }

        public List<products> SpTheoKH(int customerid)
        {
            return productsDAL.SpTheoKH(customerid);
        }

        public DataTable loadSanPhamTheoTen(string tensp)
        {
            return productsDAL.loadSanPhamTheoTen(tensp);
        }

        public bool KT_hinhanh(string image)
        {
            return productsDAL.KT_hinhanh(image);
        }

        public bool new_product(string Name, string Description, double Price, string Image, int CategoryId)
        {
            return productsDAL.new_product(Name, Description, Price, Image, CategoryId);
        }

        public bool edit_product(string Name, string Description, double Price, string Image, int CategoryId, int id)
        {
            return productsDAL.edit_product(Name, Description, Price, Image, CategoryId, id);
        }

        public bool delete_product(int id)
        {
            return productsDAL.delete_product(id);
        }
    }
}

using ADO;
using DTO;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BLL
{
    public class sizeBLL
    {
        sizeDAL sizeDAL = new sizeDAL();
        public sizeBLL()
        {

        }
        public DataTable loadSizeTheoSP(int productid)
        {
            return sizeDAL.loadSizeTheoSP(productid);
        }

        public int loadSoLuong(int productid, string sizename)
        {
            return sizeDAL.loadSoLuong(productid, sizename);
        }

        public bool new_size(int productid, string size_name, int quantity)
        {
            return sizeDAL.new_size(productid, size_name, quantity);
        }
        public bool edit_size(int productid, string size_name, int quantity)
        {
            return sizeDAL.edit_size(productid, size_name, quantity);
        }

        public bool delete_size(int productid, string size_name)
        {
            return sizeDAL.delete_size(productid, size_name);
        }

        public bool KT_size(int productid, string size_name)
        {
            return sizeDAL.KT_size(productid, size_name);
        }

        public bool delete_size_cua_sp(int productid)
        {
            return sizeDAL.delete_size_cua_sp(productid);
        }
        public int soluong(int productid, string size_name)
        {
            return sizeDAL.soluong(productid, size_name);
        }

    }
}

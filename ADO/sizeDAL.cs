using DAL;
using DTO;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ADO
{
    public class sizeDAL
    {
        DBConnect dbconn = new DBConnect();
        public sizeDAL()
        {

        }
        public DataTable loadSizeTheoSP(int productid)
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT * FROM `size` WHERE Product_Id = '" + productid + "'";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.size");
            return dt_kh;
        }

        public int loadSoLuong(int productid, string sizename)
        {
            int sl = 0;
            List<size> List_tt = new List<size>();
            string selectstring = "SELECT * FROM `size` WHERE Product_Id = '" + productid + "' AND Size_Name = '" + sizename + "'";
            MySqlDataReader reader = dbconn.execute_Reader(selectstring);
            while (reader.Read())
            {
                sl = Int32.Parse(reader["Quantity"].ToString());
            }
            reader.Close();
            return sl;
        }

        public bool new_size(int productid, string size_name, int quantity)
        {
            try
            {
                string insertString = "INSERT INTO `size`(`Product_Id`, `Size_Name`, `Quantity`) VALUES (" + productid + ",'" + size_name + "'," + quantity + ")";
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
        public bool edit_size(int productid, string size_name, int quantity)
        {
            try
            {
                string insertString = "UPDATE `size` SET `Quantity`=" + quantity + " WHERE Product_Id = " + productid + " and Size_Name = '" + size_name + "'";
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

        public bool delete_size(int productid, string size_name)
        {
            try
            {
                string insertString = "DELETE FROM `size` WHERE Product_Id = " + productid + " and Size_Name = '" + size_name + "'";
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

        public bool KT_size(int productid ,string size_name)
        {
            dbconn.openConnecttion();
            string selectstring = "SELECT * FROM `size` WHERE Product_Id = " + productid + " and Size_Name = '" + size_name + "' ";
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

        public bool delete_size_cua_sp(int productid)
        {
            try
            {
                string insertString = "DELETE FROM `size` WHERE Product_Id = " + productid + " ";
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

        public int soluong(int productid, string size_name)
        {
            try
            {
                string selectstring = "SELECT Quantity FROM `size` WHERE Product_Id = " + productid + " and Size_Name = '" + size_name + "' ";
                object kq = dbconn.execute_Scalar(selectstring);
                if (kq != DBNull.Value)
                {
                    return (int)kq;
                }
            }
            catch
            {
                return 0;
            }
            return 0;
        }

    }
}

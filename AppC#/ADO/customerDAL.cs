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
    public class customerDAL
    {

        DBConnect dbconn = new DBConnect();
        public customerDAL()
        {

        }
        public DataTable loadKHTheoSDT()
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "select * from customer";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.customer");
            return dt_kh;
        }
        public List<customer> Thongtin1kh(string SDT)
        {
            List<customer> List_tt = new List<customer>();
            string selectstring = "select * from customer where Phome = '" + SDT + "'";
            DataTable dt_tt = dbconn.getDatatable(selectstring, "dbo.customer");
            foreach (DataRow item in dt_tt.Rows)
            {
                customer san = new customer(item);
                List_tt.Add(san);
            }
            return List_tt;
        }
        public bool ThemKH(string name, string phone)
        {
            try
            {
                string insertString = "INSERT INTO `customer`(`Name`, `Phome`) VALUES ('" + name + "', '" + phone + "')";
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
        public DataTable loadKhachHang()
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT `Id`, `Name`, `Phome`, `Email` FROM `customer`";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.customer");
            return dt_kh;
        }
        public bool KT_email(string email)
        {
            dbconn.openConnecttion();
            string selectstring = "select * from customer where Email = '" + email + "' ";
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
        public bool them_khachhang(string ten, string email, string phone)
        {
            try
            {
                string insertString = "INSERT INTO `customer`(`Name`, `Phome`, `Email`) VALUES('" + ten + "', '" + phone + "', '" + email + "')";
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

        public bool sua_khachhang(string ten, string email, string phone, int makh)
        {
            try
            {
                string insertString = "UPDATE `customer` SET `Name`='" + ten + "',`Phome`='" + phone + "',`Email`='" + email + "' WHERE Id = '" + makh + "'";
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

        public bool xoa_khachhang(int makh)
        {
            try
            {
                string insertString = "DELETE FROM `customer` WHERE Id = " + makh + "";
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

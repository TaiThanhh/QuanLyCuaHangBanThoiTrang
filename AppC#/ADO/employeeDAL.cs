
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using DTO;
using MySqlX.XDevAPI.Common;

namespace DAL
{
    public class employeeDAL
    {
        DBConnect dbconn = new DBConnect();
        public employeeDAL()
        {

        }
        public bool KT_dangnhap(string email, string pass)
        {
            dbconn.openConnecttion();
            string selectstring = "select * from employee where Email = '" + email + "' and Password = '" + pass + "'";
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


        public List<employee> Thongtin1nv(string email)
        {
            List<employee> List_tt = new List<employee>();
            string selectstring = "select * from employee where Email = '" + email + "'";
            DataTable dt_tt = dbconn.getDatatable(selectstring, "dbo.employee");
            foreach (DataRow item in dt_tt.Rows)
            {
                employee san = new employee(item);
                List_tt.Add(san);
            }
            return List_tt;
        }

        public bool capnhatmatkhau(string password, int employeeid)
        {
            try
            {
                string insertString = "UPDATE `employee` SET `Password`='" + password + "' WHERE Id = '" + employeeid + "'";
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

        public DataTable loadNhanVien()
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT `Id`, `Name`, `Email`, `IsAdmin` FROM `employee`";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.employee");
            return dt_kh;
        }

        public bool KT_email(string email)
        {
            dbconn.openConnecttion();
            string selectstring = "select * from employee where Email = '" + email + "' ";
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
        public bool them_nhanvien(string ten, string email, string pass, bool quyen)
        {
            try
            {
                string insertString = "INSERT INTO `employee`(`Name`, `Email`, `Password`, `IsAdmin`) VALUES('" + ten + "', '" + email + "', '" + pass + "', " + quyen + ")";
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

        public bool sua_nhanvien(string ten, string email, bool quyen, int manv)
        {
            try
            {
                string insertString = "UPDATE `employee` SET `Name`='" + ten + "',`Email`='" + email + "',`IsAdmin`=" + quyen + " WHERE Id = '" + manv + "'";
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

        public bool xoa_nhanvien(int manv)
        {
            try
            {
                string insertString = "DELETE FROM `employee` WHERE Id = " + manv + "";
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

        public bool KT_admin(string email, string pass)
        {
            try
            {
                string selectstring = "select IsAdmin from employee where Email = '" + email + "' and Password = '" + pass + "'";
                object kq = dbconn.execute_Scalar(selectstring);
                if (kq != DBNull.Value)
                {
                    return (bool)kq;
                }
            }
            catch
            {
                return false;
            }
            return false;
        }
    }
}

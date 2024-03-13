using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Runtime.InteropServices.WindowsRuntime;
using System.Text;
using System.Threading.Tasks;
using DAL;
using MySql.Data.MySqlClient;
using DTO;



namespace BLL
{
    public class employeeBLL
    {
        employeeDAL emp = new employeeDAL();
        public employeeBLL()
        {

        }

        public bool KT_dangnhap(string email, string pass)
        {
            return emp.KT_dangnhap(email, pass);
        }

        public List<employee> Thongtin1nv(string email)
        {
            return emp.Thongtin1nv(email);
        }

        public bool capnhatmatkhau(string password, int employeeid)
        {
            return emp.capnhatmatkhau(password, employeeid);
        }

        public DataTable loadNhanVien()
        {
            return emp.loadNhanVien();
        }
        public bool KT_email(string email)
        {
            return emp.KT_email(email);
        }
        public bool them_nhanvien(string ten, string email, string pass, bool quyen)
        {
            return emp.them_nhanvien(ten, email, pass, quyen);
        }

        public bool sua_nhanvien(string ten, string email, bool quyen, int manv)
        {
            return emp.sua_nhanvien(ten, email, quyen, manv);
        }

        public bool xoa_nhanvien(int manv)
        {
            return emp.xoa_nhanvien(manv);
        }

        public bool KT_admin(string email, string pass)
        {
            return emp.KT_admin(email, pass);
        }
    }
}

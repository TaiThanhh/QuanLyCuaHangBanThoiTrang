using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Drawing;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using ADO;
using MySql.Data.MySqlClient;


namespace Control
{
    public partial class Ctrl_DangNhap: UserControl
    {
        DBConnect dbconn = new DBConnect();
        public Ctrl_DangNhap()
        {
            InitializeComponent();
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
        public string btn_dangnhap_Click(object sender, EventArgs e)
        {
            string mail = null;
            string email = txt_email.Text;
            string matkhau = txt_password.Text;
            if (email.Trim() == "")
                MessageBox.Show("bạn chưa nhập email");
            else if (matkhau.Trim() == "")
                MessageBox.Show("bạn chưa nhập mật khẩu");
            else
            {
                if (KT_dangnhap(email, matkhau) == false)
                    MessageBox.Show("Tài khoản hoặc mật khẩu không đúng");
                else
                {
                    MessageBox.Show("Đăng Nhập thành công");
                    //Dat_San datsan = new Dat_San(email);
                    //this.Hide();
                    //datsan.ShowDialog();
                    mail = email;
                }

            }
            return mail;
        }
    }
}

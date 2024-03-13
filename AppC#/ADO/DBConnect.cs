using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

namespace DAL
{
    public class DBConnect
    {
        DataSet ds;
        public DataSet DS
        {
            get { return ds; }
            set { ds = value; }
        }
        MySqlConnection connect;
        public MySqlConnection Connect
        {
            get { return connect; }
            set { connect = value; }
        }

        public DBConnect()
        {
            connect = new MySqlConnection("datasource=127.0.0.1;port=3306;username=root;password=mysql;database=db_shop");
            DS = new DataSet();
        }

        public DBConnect(string severname, string databasenname, string id, string pass)
        {
            string connectString = "Data Source=";
            connectString += severname + ";Initial Catalog=";
            connectString += databasenname + ";User ID=";
            connectString += id + "; Password = " + pass;
            connect = new MySqlConnection(connectString);
        }
        public DBConnect(string datasource, string port, string usernamer, string pass, string database)
        {
            string connectString = "datasource=";
            connectString += datasource + ";port=";
            connectString += port + ";username=";
            connectString += usernamer + ";password=";
            connectString += pass + ";database=" + database;
            connect = new MySqlConnection(connectString);
        }

        public void openConnecttion()
        {
            if (connect.State.ToString() == "Closed")
                connect.Open();
        }

        public void closedConnecttion()
        {
            if (connect.State.ToString() == "Open")
                connect.Close();
        }
        public int execute_NonQuery(string sql)
        {
            MySqlCommand cmd;
            openConnecttion();
            cmd = new MySqlCommand(sql, Connect);
            int kq = cmd.ExecuteNonQuery();
            closedConnecttion();
            return kq;
        }

        public object execute_Scalar(string sql)
        {
            MySqlCommand cmd;
            openConnecttion();
            cmd = new MySqlCommand(sql, Connect);
            object kq = cmd.ExecuteScalar();
            closedConnecttion();
            return kq;
        }   

        public MySqlDataReader execute_Reader(string sql)
        {
            MySqlCommand cmd;
            openConnecttion();
            cmd = new MySqlCommand(sql, Connect);
            MySqlDataReader rd = cmd.ExecuteReader();
            return rd;
        }

        public DataTable getDatatable(string sql, string tablename)
        {
            MySqlDataAdapter da = new MySqlDataAdapter(sql, Connect);
            DS.Clear();
            da.Fill(DS, tablename);
            return DS.Tables[tablename];
        }
    }
}

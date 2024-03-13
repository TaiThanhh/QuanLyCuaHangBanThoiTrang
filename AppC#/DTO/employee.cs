using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data.SqlClient;

namespace DTO
{
    public class employee
    {
        int id;
        string name;
        string email;
        string password;
        bool isAdmin;

        public int Id { get => id; set => id = value; }
        public string Name { get => name; set => name = value; }
        public string Email { get => email; set => email = value; }
        public string Password { get => password; set => password = value; }
        public bool IsAdmin { get => isAdmin; set => isAdmin = value; }

        public employee()
        {

        }

        public employee(DataRow row)
        {
            this.Id = Int32.Parse(row["Id"].ToString());
            this.Name = row["Name"].ToString();
            this.Email = row["Email"].ToString();
            this.Password = row["Password"].ToString();
            this.IsAdmin = bool.Parse(row["IsAdmin"].ToString());
        }
    }
}

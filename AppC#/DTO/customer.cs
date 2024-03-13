using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DTO
{
    public class customer
    {
        int id;
        string name;
        string phone;
        string email;
        string password;

        public int Id { get => id; set => id = value; }
        public string Phone { get => phone; set => phone = value; }
        public string Email { get => email; set => email = value; }
        public string Name { get => name; set => name = value; }
        public string Password { get => password; set => password = value; }

        public customer()
        {

        }

        public customer(DataRow row)
        {
            this.Id = Int32.Parse(row["Id"].ToString());
            this.Name = row["Name"].ToString();
            this.Phone = row["Phome"].ToString();
            this.Email = row["Email"].ToString();
            this.Password = row["Password"].ToString();
        }
    }
}

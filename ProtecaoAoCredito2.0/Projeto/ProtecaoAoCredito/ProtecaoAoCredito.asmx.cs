using System;
using System.Collections.Generic;
using System.Web;
using System.Web.Services;

namespace ProtecaoAoCredito
{
    public struct ConsultaCPF
    {
        public String situacao;
        public String codigoRetorno;
        public String msgRetorno;

        public ConsultaCPF(String situacao, String codigoRetorno, String msgRetorno)
        {
            this.situacao = situacao;
            this.codigoRetorno = codigoRetorno;
            this.msgRetorno = msgRetorno;

        }

    }

    /// <summary>
    /// Summary description for ProtecaoAoCredito
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]

    public class ProtecaoAoCredito : System.Web.Services.WebService
    {

        [WebMethod]
        public ConsultaCPF consultaCPF(String CPF)
        {
            ConsultaCPF reply;

            if (!validaCPF(CPF))
            {
                reply = new ConsultaCPF("", "01", "CPF invalido");
            }
            else
            {
                int ultimoDigito = Int32.Parse(CPF.Substring(10, 1));

                switch (ultimoDigito)
                {
                    case 0:
                    case 4:
                    case 5:
                    case 7:
                        reply = new ConsultaCPF("regular", "00", "Consulta realizada com sucesso");
                        break;
                    case 1:
                    case 3:
                    case 6:
                    case 8:
                        reply = new ConsultaCPF("irregular", "00", "Consulta realizada com sucesso");
                        break;
                    default:
                        reply = new ConsultaCPF("", "02", "CPF nao encontrado");
                        break;
                }
            }

            return reply;
        }

        private static bool validaCPF(string CandidatoACpf)
        {
            CandidatoACpf = CandidatoACpf.Replace("-", "").Replace(".", "").Replace(",", "").Replace(" ", "").Replace("_", "");

            switch (CandidatoACpf)
            {
                case "11111111111":
                case "00000000000":
                case "22222222222":
                case "33333333333":
                case "44444444444":
                case "55555555555":
                case "66666666666":
                case "77777777777":
                case "88888888888":
                case "99999999999":
                    return false;
            }
            if (CandidatoACpf.Length != 11)
                return false;
            int add = 0;
            int rev = 0;
            for (int i = 0; i < 9; i++)
                add += (int.Parse(CandidatoACpf[i].ToString()) * (10 - i));
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev.ToString() != CandidatoACpf[9].ToString())
                return false;
            add = 0;
            for (int i = 0; i < 10; i++)
                add += int.Parse(CandidatoACpf[i].ToString()) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev.ToString() != CandidatoACpf[10].ToString())
                return false;
            return true;
        }
    }
}

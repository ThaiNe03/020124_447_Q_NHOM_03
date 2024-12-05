import { useNavigate } from 'react-router-dom';
import { useState } from 'react';
import axios from 'axios';
import Cookies from 'js-cookie';
import Swal from 'sweetalert2';
import './style.scss';

function Login() {
  const navigate = useNavigate();

  const [email, setEmail] = useState('');
  const [passWord, setPassWord] = useState('');

  const handleLogin = async () => {
    if (email == '' || passWord == '') {
      Swal.fire({
        title: 'Warning ?',
        text: 'Please enter information',
        icon: 'warning',
      });
      return;
    }

    const response = await axios.post(
      `${import.meta.env.VITE_DOMAIN}api/admin/login`,
      {
        email,
        password: passWord,
      },
      {
        headers: {
          'Content-Type': 'application/json',
        }
      }
    );

    if(response.data.success ){
      Cookies.set('Auth', response.data.Auth, {
        expires: 30,
        path: '/',
      });
      Cookies.set('token', response.data.token, {
        expires: 30,
        path: '/',
      });
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Login Success',
        showConfirmButton: false,
        timer: 1500,
      });

      setTimeout(() => {
        navigate('/');
      }, 2000);
    }else{
      Swal.fire({
        title: 'Login Fail ?',
        text: "Fails",
        icon: 'error',
      });
    }
  };

  return (
    <>
      <div className="block-login">
        <div className="block-form-login">
          <h2>Đăng nhập</h2>
          <div className="form-input">
            <label htmlFor="inputEmail">Email đăng nhập</label>
            <input
              id="inputEmail"
              placeholder="Email đăng nhập"
              type="email"
              onBlur={(e) => setEmail(e.target.value)}
            />
          </div>
          <div className="form-input">
            <label htmlFor="inputPass">Mật khẩu</label>
            <input id="inputPass" placeholder="Mật khẩu" type="password" onBlur={(e) => setPassWord(e.target.value)} />
          </div>

          <div className="btn-login" onClick={handleLogin}>
            Đăng nhập
          </div>
        </div>
      </div>
    </>
  );
}
export default Login;

import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

axios.defaults.withCredentials = true;

const LoginAdmin = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [errorMessage, setErrorMessage] = useState('');
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post("http://localhost/api/login", {
        username,
        password,
      });
      console.log(response.data);
      localStorage.setItem('adminData', JSON.stringify(response.data));
      navigate('/dashboardAdmin'); // Navigate to the admin dashboard after login
    } catch (error) {
      if (error.response) {
        setErrorMessage(error.response.data.msg);
      } else {
        setErrorMessage('Login failed, please try again.');
      }
    }
  };

  return (
    <div className="login-form" style={{ width: '300px', margin: '50px auto', padding: '20px', border: '1px solid #ccc', borderRadius: '10px', boxShadow: '0 2px 5px rgba(0, 0, 0, 0.1)' }}>
      <h2>Login Admin</h2>
      {errorMessage && <p className="error" style={{ color: 'red' }}>{errorMessage}</p>}
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="username">Username:</label>
          <input
            type="text"
            id="username"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
            style={{ width: '100%', padding: '8px', boxSizing: 'border-box' }}
          />
        </div>
        <div className="form-group">
          <label htmlFor="password">Password:</label>
          <input
            type="password"
            id="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            autoComplete="current-password"
            style={{ width: '100%', padding: '8px', boxSizing: 'border-box' }}
          />
        </div>
        <button type="submit" style={{ width: '100%', padding: '10px', backgroundColor: '#007bff', border: 'none', color: 'white', borderRadius: '5px', cursor: 'pointer', marginTop: '15px' }}>Login</button>
      </form>
    </div>
  );
};

export default LoginAdmin;

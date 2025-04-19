import React, {useState} from 'react';
import axios from 'axios';
export default function Login() {
  const [form,setForm]=useState({email:'',password:''});
  const submit=async e=>{e.preventDefault();await axios.post('/login',form);window.location='/';};
  return (<form onSubmit={submit}>/* inputs */</form>);
}
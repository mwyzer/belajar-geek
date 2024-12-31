//import hook react
import React, { useState } from "react";

//import Head, usePage, Link and router
import { Head, usePage, Link, router } from '@inertiajs/react';

export default function Login() {

    const handleGoogleLogin = () => {
        window.location.href = '/auth/google';
    };


    //destruct props "errors"
    const { errors } = usePage().props;

    //state user
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    //function "loginHandler"
    const loginHandler = async (e) => {
        e.preventDefault();

        //login
        router.post('/login', {
            email: email,
            password: password
        });
    }

    return (
        <>
            <Head>
                <title>Login Account - Geek Store</title>
            </Head>
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-4 mt-80">
                        <div className="text-center mb-4">
                            <img src="/assets/images/logo.png" width={'60'} />
                            <h4><strong>GEEK</strong> STORE</h4>
                        </div>
                        <div className="card border-0 rounded-3 shadow-sm border-top-success">
                            <div className="card-body">
                                <div className="text-center">
                                    <h6 className="fw-bold">LOGIN ACCOUNT</h6>
                                    <hr />
                                </div>
                                <form onSubmit={loginHandler}>

                                    <label className="mb-1">Email Address</label>
                                    <div className="input-group mb-3">
                                        <span className="input-group-text"><i className="fa fa-envelope"></i></span>
                                        <input type="text" className="form-control" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="Email Address" />
                                    </div>
                                    {errors.email && (
                                        <div className="alert alert-danger">
                                            {errors.email}
                                        </div>
                                    )}

                                    <label className="mb-1">Password</label>
                                    <div className="input-group mb-3">
                                        <span className="input-group-text"><i className="fa fa-lock"></i></span>
                                        <input type="password" className="form-control" value={password} onChange={(e) => setPassword(e.target.value)} placeholder="Password" />
                                    </div>
                                    {errors.password && (
                                        <div className="alert alert-danger">
                                            {errors.password}
                                        </div>
                                    )}
                                    <div className="d-grid gap-2"> {/* Added container for buttons */}
                                        <button
                                            className="btn btn-success shadow-sm rounded-sm px-4 w-100"
                                            type="submit">
                                            LOGIN
                                        </button>

                                        <button
                                            type="button"
                                            onClick={handleGoogleLogin}
                                            className="btn btn-success shadow-sm rounded-sm px-4 w-100">
                                            <i className="fab fa-google me-2"></i>
                                            Login with Google
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div className="register text-center mt-3">
                            Need an account? <Link href="/register">Register!</Link>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )

}
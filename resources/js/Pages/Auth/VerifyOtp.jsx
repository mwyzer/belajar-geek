import React, { useState } from 'react';
import { Head, router, usePage } from '@inertiajs/react';

export default function VerifyOTP() {
    const { errors } = usePage().props;
    const [email, setEmail] = useState('');
    const [otp, setOtp] = useState('');

    const sendOtpHandler = (e) => {
        e.preventDefault();
        router.post('/otp/send', { email });
    };

    const verifyOtpHandler = (e) => {
        e.preventDefault();
        router.post('/otp/verify', { email, otp });
    };

    return (
        <>
            <Head title="Verify OTP - Geek Store" />
            <div className="container mt-5">
                <h3 className="text-center">Verify Your Email</h3>
                <form onSubmit={sendOtpHandler}>
                    <div className="mb-3">
                        <label>Email Address</label>
                        <input
                            type="email"
                            className="form-control"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            placeholder="Enter your email"
                        />
                    </div>
                    <button type="submit" className="btn btn-primary w-100">Send OTP</button>
                </form>

                <hr />

                <form onSubmit={verifyOtpHandler}>
                    <div className="mb-3">
                        <label>OTP Code</label>
                        <input
                            type="text"
                            className="form-control"
                            value={otp}
                            onChange={(e) => setOtp(e.target.value)}
                            placeholder="Enter OTP"
                        />
                    </div>
                    <button type="submit" className="btn btn-success w-100">Verify OTP</button>
                </form>

                {errors.email && <div className="alert alert-danger mt-2">{errors.email}</div>}
                {errors.otp && <div className="alert alert-danger mt-2">{errors.otp}</div>}
            </div>
        </>
    );
}

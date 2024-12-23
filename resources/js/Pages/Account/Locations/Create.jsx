// Import React  
import React, { useState } from "react";

// Import layout
import LayoutAccount from '../../../Layouts/Account';

// Import Head, usePage, and router
import { Head, usePage, router } from '@inertiajs/react';

// Import Sweet Alert
import Swal from 'sweetalert2';

export default function LocationCreate() {
    // Destructure props "errors"
    const { errors } = usePage().props;

    // State for name, address, and image
    const [name, setName] = useState("");
    const [address, setAddress] = useState("");
    const [image, setImage] = useState(null);

    // Handle image change
    const handleImageChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setImage(file);
        }
    };

    // Method "storeLocation"
    const storeLocation = async (e) => {
        e.preventDefault();

        // Create FormData for file upload
        const formData = new FormData();
        formData.append('name', name);
        formData.append('address', address);
        if (image) {
            formData.append('image', image);
        }

        // Sending data
        router.post('/account/locations', formData, {
            forceFormData: true, // Ensure data is sent as multipart/form-data
            onSuccess: () => {
                // Show alert
                Swal.fire({
                    title: 'Success!',
                    text: 'Data saved successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Clear state
                setName('');
                setAddress('');
                setImage(null);
                document.getElementById('imageInput').value = '';
            }
        });
    };

    return (
        <>
            <Head>
                <title>Create Location - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold"><i className="fa fa-map-marker-alt"></i> Add New Location</span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={storeLocation} encType="multipart/form-data">
                                    {/* Name Input */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Location Name</label>
                                        <input 
                                            type="text" 
                                            className="form-control" 
                                            value={name} 
                                            onChange={(e) => setName(e.target.value)} 
                                            placeholder="Enter Location Name" 
                                        />
                                        {errors.name && (
                                            <div className="alert alert-danger mt-2">
                                                {errors.name}
                                            </div>
                                        )}
                                    </div>

                                    {/* Address Input */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Location Address</label>
                                        <input 
                                            type="text" 
                                            className="form-control" 
                                            value={address} 
                                            onChange={(e) => setAddress(e.target.value)} 
                                            placeholder="Enter Location Address" 
                                        />
                                        {errors.address && (
                                            <div className="alert alert-danger mt-2">
                                                {errors.address}
                                            </div>
                                        )}
                                    </div>

                                    {/* Image Input */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Location Image</label>
                                        <input 
                                            id="imageInput"
                                            type="file" 
                                            className="form-control" 
                                            onChange={handleImageChange} 
                                            accept="image/png, image/jpg"
                                        />
                                        {errors.image && (
                                            <div className="alert alert-danger mt-2">
                                                {errors.image}
                                            </div>
                                        )}
                                    </div>

                                    {/* Action Buttons */}
                                    <div>
                                        <button type="submit" className="btn btn-md btn-success me-2">
                                            <i className="fa fa-save"></i> Save
                                        </button>
                                        <button type="reset" className="btn btn-md btn-warning">
                                            <i className="fa fa-redo"></i> Reset
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}

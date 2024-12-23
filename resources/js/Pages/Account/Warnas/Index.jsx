//import react  
import React from "react";

//import layout
import LayoutAccount from '../../../Layouts/Account';

//import Head, usePage, Link
import { Head, usePage, Link } from '@inertiajs/react';

//import permissions
import hasAnyPermission from '../../../Utils/Permissions';

//import component search
import Search from '../../../Shared/Search';

//import component pagination
import Pagination from '../../../Shared/Pagination';

export default function WarnasIndex() {

    //destruct props "warnas"
    const { warnas } = usePage().props;

    return(
        <>
            <Head>
                <title>warnas - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3 col-12 mb-2">
                                <Link href="/account/warnas/create" class="btn btn-md btn-success border-0 shadow w-100" type="button">
                                    <i class="fa fa-plus-circle me-2"></i>
                                    Tambah
                                </Link>
                            </div>
                            <div class="col-md-9 col-12 mb-2">
                                <Search URL={'/account/warnas'}/>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="row mt-2 mb-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold"><i className="fa fa-palette"></i> warnas</span>
                            </div>
                            <div className="card-body">
                                <div className="table-responsive">
                                    <table className="table table-bordered table-striped table-hovered">
                                        <thead>
                                        <tr>
                                            <th scope="col" style={{ width: '5%' }}>No.</th>
                                            <th scope="col" style={{ width: '15%' }}>Name</th>
                                            <th scope="col" style={{ width: '15%' }}>Warna</th>
                                            <th scope="col" style={{ width: '15%' }}>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            {warnas.data.map((warna, index) => (
                                                <tr key={index}>
                                                    <td className="text-center">{++index + (warnas.current_page-1) * warnas.per_page}</td>
                                                    <td>{warna.name}</td>
                                                    <td className="text-center">
                                                        <img src={warna.image} className="rounded-circle" width={'30'}/>
                                                    </td>
                                                    <td className="text-center">
                                                        {hasAnyPermission(['warnas.edit']) &&
                                                            <Link href={`/account/warnas/${warna.id}/edit`} className="btn btn-primary btn-sm me-2"><i className="fa fa-pencil-alt"></i></Link>
                                                        }
                                                        {hasAnyPermission(['warnas.delete']) &&
                                                            <button className="btn btn-danger btn-sm"><i className="fa fa-trash"></i></button>
                                                        }
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>

                                <Pagination links={warnas.links} align={'end'}/>

                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    )

}
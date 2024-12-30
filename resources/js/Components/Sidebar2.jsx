//import React
import React from "react";

//import permissions
import hasAnyPermission from '../Utils/Permissions';

//import Link and usePage
import { Link, usePage } from '@inertiajs/react';

export default function Sidebar() {
    const { url } = usePage();

    return (
        <>
            <div className="list-group list-group-flush">

                {hasAnyPermission(['warnas.index']) &&
                    <Link href="/account/warnas" className={`${url.startsWith('/account/warnas') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-map-marker-alt me-2"></i> Warnas
                    </Link>
                }
            </div>
        </>
    );
}

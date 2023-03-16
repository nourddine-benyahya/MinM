import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { InertiaLink } from '@inertiajs/inertia-react';


export default function Edit({posts, auth, mustVerifyEmail, status }) {
    console.log(posts)

    return (
        <AuthenticatedLayout
            auth={auth}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">My Posts</h2>}
        >
            <Head title="Profile" />
        
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div>{status}</div>
                        <a href="/posts/1">my post</a>

                    </div>

                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                       
                    </div>

                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

import { useEffect, useState } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import NumberInput from '@/components/NumberInput';
import FileInput from '@/components/FileInput';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function AddGroup({ auth, mustVerifyEmail, status }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        image: '',
        description: '',
        name:''
    }); 
  

    const handleOnChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault(); 

        console.log(data.file)
        post(route('addgroups'));
    };

    return (
        <AuthenticatedLayout
        auth={auth}
        header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Add Post</h2>}
    >
        <GuestLayout>
            <Head title="addgroup" />
            <form onSubmit={submit} enctype="multipart/form-data">
                <div>
                    <InputLabel htmlFor="name" value="name" />

                    <TextInput
                        id="name"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={handleOnChange}
                        required
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>


                <div>
                    <InputLabel htmlFor="image" value="image" />

                    <FileInput
                        id="image"
                        name="image"
                        className="mt-1 block w-full"
                        autoComplete="image"
                        isFocused={true}
                        onChange={(e) =>
                            setData("image",e.target.files[0])
                        }
                        required
                    />

                    <InputError message={errors.image} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="description" value="description" />

                    <TextInput
                        id="description"
                        name="description"
                        value={data.description}
                        className="mt-1 block w-full"
                        autoComplete="description"
                        isFocused={true}
                        onChange={handleOnChange}
                        required
                    />

                    <InputError message={errors.description} className="mt-2" />
                </div>


                
                <div className="flex items-center justify-end mt-4">

                    <PrimaryButton className="ml-4" disabled={processing}>
                        Post
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
        </AuthenticatedLayout>
    );
}

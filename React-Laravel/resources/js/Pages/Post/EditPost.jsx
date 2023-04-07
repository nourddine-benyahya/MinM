import { useEffect } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import NumberInput from '@/components/NumberInput';
import FileInput from '@/components/FileInput';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';


export default function EditPost({posts , files , auth, mustVerifyEmail, status }) {

    const { data, setData,delete: destroy, post, processing, errors, reset } = useForm({
        file: '',
        body: files.message_text
    });



    const handleOnChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        destroy(route('message.destroy',{id:3}));
    };

    return (
        <AuthenticatedLayout
        auth={auth}
        header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Edit Post</h2>}
    >
        <GuestLayout>
            <Head title="addpost" />
            <form onSubmit={submit}>
                <div>
                    <InputLabel htmlFor="body" value="body" />

                    <TextInput
                        id="body"
                        name="body"
                        value={data.body}
                        className="mt-1 block w-full"
                        autoComplete="body"
                        isFocused={true}
                        onChange={handleOnChange}
                        required
                    />

                    <InputError message={errors.body} className="mt-2" />
                </div>


                <div>
                    <InputLabel htmlFor="file" value="file" />

                    <FileInput
                        id="file"
                        name="file"
                        className="mt-1 block w-full"
                        autoComplete="file"
                        isFocused={true}
                        onChange={(e) =>
                            setData("file",e.target.files[0])
                        }
                    />

                    <InputError message={errors.file} className="mt-2" />
                </div>
                
                <div className="flex items-center justify-end mt-4">

                    <PrimaryButton className="ml-4" disabled={processing}>
                        EditPost
                    </PrimaryButton>
                </div>
            </form>

        </GuestLayout>
        </AuthenticatedLayout>

    );
}

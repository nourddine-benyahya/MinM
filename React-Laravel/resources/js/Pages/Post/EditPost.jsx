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

export default function AddPost({posts , file , auth, mustVerifyEmail, status }) {
    console.log(file.message_text)
    console.log(file.message_file)
    const { data, setData, post, processing, errors, reset } = useForm({
        message_file: '',
        message_text: file.message_text
    });

  

    const handleOnChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route("/updatepost/1"));
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
                    <InputLabel htmlFor="message_text" value="message_text" />

                    <TextInput
                        id="message_text"
                        name="message_text"
                        value={data.message_text}
                        className="mt-1 block w-full"
                        autoComplete="message_text"
                        isFocused={true}
                        onChange={handleOnChange}
                        required
                    />

                    <InputError message={errors.message_text} className="mt-2" />
                </div>


                <div>
                    <InputLabel htmlFor="message_file" value="message_file" />

                    <FileInput
                        id="message_file"
                        name="message_file"
                        value={data.message_file}
                        className="mt-1 block w-full"
                        autoComplete="message_file"
                        isFocused={true}
                        onChange={handleOnChange}
                        required
                    />

                    <InputError message={errors.message_file} className="mt-2" />
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

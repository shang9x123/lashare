import React, {useState} from "react";
import {Button, Form} from "react-bootstrap";
import axios from "axios";
import {useNavigate} from 'react-router-dom';

const Post = () => {
    const [isLoading, setLoading] = useState(true)
    const [image, setImage] = useState('');
    const [imagereturn, setImagereturn] = useState(null);
    const navigate = useNavigate();
    const uploadfile = async (event: any) => {
        const formData = new FormData();
        formData.append("image", image);
        const result = await axios.post('http://127.0.0.1:8000/api/upload', formData);
        setImagereturn(result.data)
        setLoading(false);
    }
    // nếu mà load xong tức là láy được dữ liệu về
    if (!isLoading)
        console.log(imagereturn);
        if (imagereturn != null) {
            var link1 = 'http://127.0.0.1:8000' + imagereturn.url;
            console.log(link1);
            localStorage.setItem('image',link1);
           // navigate('/');
            return (
                <>
                    <img src={link1} style={{width:"20%"}}/>
                    <h3>{link1}</h3>
                    <Form>
                        <Form.Group>
                            <Form.Label>Choose FIle</Form.Label>
                            <Form.Control type='file' name='image'
                                          onChange={(event) => setImage(event.target.files[0])}></Form.Control>
                        </Form.Group>
                        <Button onClick={uploadfile}>Upload</Button>
                    </Form>
                </>
            )
        }
    // xong phần loadding
    return (
        <>
            <Form>
                <Form.Group>
                    <Form.Label>Choose FIle</Form.Label>
                    <Form.Control type='file' name='image'
                                  onChange={(event) => setImage(event.target.files[0])}></Form.Control>
                </Form.Group>
                <Button onClick={uploadfile}>Upload</Button>
            </Form>
        </>
    );
}
export default Post;

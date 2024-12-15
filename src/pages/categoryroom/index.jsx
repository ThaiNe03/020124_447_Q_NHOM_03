import { useEffect, useState } from 'react';
import { Table, Button, Input, Space, Modal, Form } from 'antd';
import { DeleteOutlined, EditOutlined } from '@ant-design/icons';
import Cookies from 'js-cookie';
import Swal from 'sweetalert2';
import axios from 'axios';
import noImage from '/img/no-image.avif';

import './style.scss';

// const { Search } = Input;

const CategoryRoom = () => {
  const token = Cookies.get('token');
  const [form] = Form.useForm();
  const [formEdit] = Form.useForm();

  const [roomType, setRoomType] = useState('');
  const [adult, setAdult] = useState('');
  const [children, setChildren] = useState('');
  const [size, setSize] = useState('');
  const [imageLink, setImageLink] = useState('');

  const [listUser, setListUser] = useState([]);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [isModalOpenEdit, setIsModalOpenEdit] = useState(false);
  const [selectedUser, setSelectedUser] = useState({});
  const columns = [
    {
      title: 'ID',
      dataIndex: 'id',
      key: 'id',
    },
    {
      title: 'Room type',
      dataIndex: 'room_type',
      key: 'room_type',
    },
    {
      title: 'Adult',
      dataIndex: 'adult',
      key: 'adult',
    },
    {
      title: 'Count Children',
      dataIndex: 'num_children',
      key: 'num_children',
    },
    {
      title: 'Size',
      dataIndex: 'size',
      key: 'size',
    },
    {
      title: 'Image',
      dataIndex: 'image',
      key: 'image',
      render: (image) => <img src={image ? image : noImage} style={{ width: '100px', height: '100px' }} />,
    },
    {
      title: 'Status',
      dataIndex: 'status',
      key: 'status',
      render: (status) => (status === 1 ? 'Active' : 'Inactive'),
    },
    {
      title: 'Actions',
      key: 'actions',
      render: (text, record) => (
        <Space>
          <Button icon={<EditOutlined />} onClick={() => handleEdit(record)} />
          <Button icon={<DeleteOutlined />} danger onClick={() => handleDelete(record.id)} />
        </Space>
      ),
    },
  ];

  const getUserAPI = async () => {
    try {
      const response = await axios.get(`${import.meta.env.VITE_DOMAIN}api/admin/list-cate-room`, {
        headers: {
          Accept: 'application/json',
          Authorization: `Bearer ${token}`,
        },
      });
      const list = Array.isArray(response.data) && Array.isArray(response.data[0]) ? response.data[0] : [];

      const processedList = list.map((item) => ({
        ...item,
        num_children: Number(item.children),
        children: undefined,
      }));

      setListUser(processedList);
    } catch (error) {
      console.error(error);
      setListUser([]);
    }
  };

  useEffect(() => {
    getUserAPI();
  }, []);

  const showModal = () => {
    form.resetFields();
    setIsModalOpen(true);
  };

  const handleOk = () => {
    setIsModalOpen(false);
  };

  const handleCancel = () => {
    setIsModalOpen(false);
  };

  const handleSignUp = async () => {
    if (!roomType || !adult || !children || !size || !imageLink) {
      Swal.fire({
        title: 'Warning: Please Complete All Required Information',
        text: 'Please fill in all the information.',
        icon: 'warning',
      });
      return;
    }

    const params = {
      room_type: roomType,
      adult: Number(adult),
      children: Number(children),
      size: Number(size),
      image: imageLink,
      status: 1,
    };

    try {
      const response = await axios.post(`${import.meta.env.VITE_DOMAIN}api/admin/create-cate-room`, params, {
        headers: {
          Accept: 'application/json',
          Authorization: `Bearer ${token}`,
        },
      });

      Swal.fire({
        position: 'center',
        icon: 'success',
        title: response.data[0],
        showConfirmButton: false,
        timer: 1500,
      });
      getUserAPI();
      handleOk();
    } catch (error) {
      console.error('Login error:', error);
      Swal.fire({
        title: 'Fail ?',
        text: error.response.data.message,
        icon: 'error',
      });
    }
  };

  const handleDelete = async (id) => {
    try {
      const response = await axios.delete(`${import.meta.env.VITE_DOMAIN}api/admin/delete-cate-room/${id}`, {
        headers: {
          Accept: 'application/json',
          Authorization: `Bearer ${token}`,
        },
      });
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: response.data[0],
        showConfirmButton: false,
        timer: 1500,
      });
      getUserAPI();
      handleOk();
    } catch (error) {
      console.error('Login error:', error);
      Swal.fire({
        title: 'Fail ?',
        text: error.response.data.message,
        icon: 'error',
      });
    }
  };

  const handleEdit = (record) => {
    setSelectedUser(record);
    setIsModalOpenEdit(true);
  };

  const handleEditCourse = async () => {
    if (!selectedUser.room_type || !selectedUser.adult || !selectedUser.num_children || !selectedUser.size) {
      Swal.fire({
        title: 'Warning: Please Complete All Required Information',
        text: 'Please fill in all the information.',
        icon: 'warning',
      });
      return;
    }

    const params = new FormData();
    params.append('room_type', selectedUser.room_type);
    params.append('adult', selectedUser.adult);
    params.append('children', selectedUser.num_children);
    params.append('size', selectedUser.size);
    params.append('status', 1);
    params.append('image', selectedUser.image);

    try {
      const response = await axios.post(
        `${import.meta.env.VITE_DOMAIN}api/admin/edit-cate-room/${selectedUser.id}`,
        params,
        {
          headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${token}`,
          },
        },
      );
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: response.data,
        showConfirmButton: false,
        timer: 1500,
      });
      getUserAPI();
      setIsModalOpenEdit(false);
    } catch (error) {
      Swal.fire({
        title: 'Request Fail ?',
        text: error,
        icon: 'error',
      });
    }
  };

  const handleEditCancel = () => {
    setIsModalOpenEdit(false);
  };

  useEffect(() => {
    if (selectedUser) {
      formEdit.setFieldsValue({
        room_type: selectedUser.room_type,
        adult: selectedUser.adult,
        children: selectedUser.num_children,
        size: selectedUser.size,
        imageLink: selectedUser.image,
      });
    }
  }, [selectedUser, formEdit]);

  return (
    <>
      <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: 16 }}>
        <Button type="primary" onClick={showModal}>
          Add Category Room
        </Button>
        {/* <Space>
          <Search placeholder="Search by name or email" style={{ width: 200 }} />
        </Space> */}
      </div>
      <Table
        columns={columns}
        dataSource={listUser.map((user) => ({
          ...user,
          key: user.id,
        }))}
      />
      <Modal
        title="Add Category Room"
        open={isModalOpen}
        onOk={handleSignUp}
        onCancel={handleCancel}
        footer={[
          <Button key="cancel" onClick={handleCancel}>
            Cancel
          </Button>,
          <Button key="submit" type="primary" onClick={handleSignUp}>
            Add Category Room
          </Button>,
        ]}
      >
        <Form layout="vertical" form={form}>
          <Form.Item
            label="Room Type"
            name="room_type"
            rules={[{ required: true, message: 'Please enter the room type!' }]}
          >
            <Input placeholder="Enter room type" value={roomType} onChange={(e) => setRoomType(e.target.value)} />
          </Form.Item>

          <Form.Item
            label="Adults"
            name="adult"
            rules={[{ required: true, message: 'Please enter the number of adults!' }]}
          >
            <Input
              type="number"
              placeholder="Enter number of adults"
              value={adult}
              onChange={(e) => setAdult(e.target.value)}
            />
          </Form.Item>

          <Form.Item
            label="Children"
            name="children"
            rules={[{ required: true, message: 'Please enter the number of children!' }]}
          >
            <Input
              type="number"
              placeholder="Enter number of children"
              value={children}
              onChange={(e) => setChildren(e.target.value)}
            />
          </Form.Item>

          <Form.Item label="Size" name="size" rules={[{ required: true, message: 'Please enter the room size!' }]}>
            <Input
              type="number"
              placeholder="Enter room size in sqft"
              value={size}
              onChange={(e) => setSize(e.target.value)}
            />
          </Form.Item>
          <Form.Item
            label="Image Link"
            name="imageLink"
            rules={[{ required: true, message: 'Please enter the Image Link!' }]}
          >
            <Input placeholder="Enter Image Link" value={imageLink} onChange={(e) => setImageLink(e.target.value)} />
          </Form.Item>
        </Form>
      </Modal>
      <Modal title="Edit Category Room" open={isModalOpenEdit} onCancel={handleEditCancel} onOk={handleEditCourse}>
        {selectedUser && (
          <Form layout="vertical" form={formEdit}>
            <Form.Item label="Room Type" name="room_type" required>
              <Input
                value={selectedUser.room_type}
                onChange={(e) => setSelectedUser({ ...selectedUser, room_type: e.target.value })}
              />
            </Form.Item>
            <Form.Item label="Adult" name="adult" required>
              <Input
                type="number"
                value={selectedUser.adult}
                onChange={(e) => setSelectedUser({ ...selectedUser, adult: e.target.value })}
              />
            </Form.Item>
            <Form.Item label="Children" name="children" required>
              <Input
                type="number"
                value={selectedUser.num_children}
                onChange={(e) => setSelectedUser({ ...selectedUser, num_children: e.target.value })}
              />
            </Form.Item>
            <Form.Item label="Size" name="size" required>
              <Input
                type="number"
                value={selectedUser.size}
                onChange={(e) => setSelectedUser({ ...selectedUser, size: e.target.value })}
              />
            </Form.Item>
            <Form.Item label="ImageLink" name="imageLink" required>
              <Input
                value={selectedUser.image}
                onChange={(e) => setSelectedUser({ ...selectedUser, image: e.target.value })}
              />
            </Form.Item>
          </Form>
        )}
      </Modal>
    </>
  );
};

export default CategoryRoom;

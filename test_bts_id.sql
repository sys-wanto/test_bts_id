PGDMP     %    /                {            test_bts_id    15.1    15.1                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    34113    test_bts_id    DATABASE     �   CREATE DATABASE test_bts_id WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE test_bts_id;
                postgres    false            �            1259    34126 	   checklist    TABLE     Y   CREATE TABLE public.checklist (
    id integer NOT NULL,
    user_id integer NOT NULL
);
    DROP TABLE public.checklist;
       public         heap    postgres    false            �            1259    34131    checklist_a_seq    SEQUENCE     x   CREATE SEQUENCE public.checklist_a_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.checklist_a_seq;
       public          postgres    false    216                       0    0    checklist_a_seq    SEQUENCE OWNED BY     D   ALTER SEQUENCE public.checklist_a_seq OWNED BY public.checklist.id;
          public          postgres    false    217            �            1259    34114    users    TABLE     �   CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(255),
    password character varying(255),
    email character varying,
    token character varying(255)
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    34124    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    214            	           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    215            k           2604    34132    checklist id    DEFAULT     k   ALTER TABLE ONLY public.checklist ALTER COLUMN id SET DEFAULT nextval('public.checklist_a_seq'::regclass);
 ;   ALTER TABLE public.checklist ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    216            j           2604    34125    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214                       0    34126 	   checklist 
   TABLE DATA           0   COPY public.checklist (id, user_id) FROM stdin;
    public          postgres    false    216   �       �          0    34114    users 
   TABLE DATA           E   COPY public.users (id, username, password, email, token) FROM stdin;
    public          postgres    false    214   �       
           0    0    checklist_a_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.checklist_a_seq', 1, false);
          public          postgres    false    217                       0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 1, true);
          public          postgres    false    215            o           2606    34130    checklist checklist_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.checklist
    ADD CONSTRAINT checklist_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.checklist DROP CONSTRAINT checklist_pkey;
       public            postgres    false    216            m           2606    34123    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    214                   x������ � �      �   o   x�3�,�,.O�+�O2�T1�T14P	�H+Htw5+�	w��v5p	�w�s��u)��O-���r1�����w,vJ�p���K�N�/.)�/wH�M���K��������� �� �     
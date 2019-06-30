<?php

namespace Polushkin\ContactUsSaver\Api\Data;

/**
 * @api
 */
interface EnquiryInterface
{
    const ENQUIRY_ID    = 'enquiry_id';
    const NAME          = 'name';
    const EMAIL         = 'email';
    const TELEPHONE     = 'telephone';
    const COMMENT       = 'comment';
    const ANSWER        = 'answer_to_comment';
    const STATUS        = 'status';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone();

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment();

    /**
     * @return string
     */
    public function getAnswerToComment();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * Set ID
     *
     * @param $id
     * @return EnquiryInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param $name
     * @return EnquiryInterface
     */
    public function setName($name);

    /**
     * Set email
     *
     * @param $email
     * @return EnquiryInterface
     */
    public function setEmail($email);

    /**
     * Set telephone
     *
     * @param $telephone
     * @return EnquiryInterface
     */
    public function setTelephone($telephone);

    /**
     * Set comment
     *
     * @param $comment
     * @return EnquiryInterface
     */
    public function setComment($comment);

    /**
     * set answer
     *
     * @param $answerToComment
     * @return EnquiryInterface
     */
    public function setAnswerToComment($answerToComment);

    /**
     * set status
     *
     * @param $status
     * @return EnquiryInterface
     */
    public function setStatus($status);
}

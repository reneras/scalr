<?php
namespace Scalr\Service\Aws\Ec2\DataType;

use Scalr\Service\Aws\DataType\StringType;

/**
 * VolumeFilterNameType
 *
 * @author   Vitaliy Demidov   <vitaliy@scalr.com>
 * @since    21.01.2013
 */
class VolumeFilterNameType extends StringType
{

    /**
     * Filters the response based on a specific tag/value combination
     *
     * To instantiate the object with the tag:Anything we need to use following construction
     * InstanceFilterNameType::tag('Anything');
     */
    const TYPE_TAG_NAME = 'tag:Name';

    /**
     * The time stamp when the attachment initiated.
     * Type: DateTime
     */
    const TYPE_ATTACHMENT_ATTACH_TIME = 'attachment.attach-time';

    /**
     * Whether the volume is deleted on instance termination.
     * Type: Boolean
     */
    const TYPE_ATTACHMENT_DELETE_ON_TERMINATION = 'attachment.delete-on-termination';

    /**
     * The device name that is exposed to the instance (for example, /dev/sda1).
     */
    const TYPE_ATTACHMENT_DEVICE = 'attachment.device';

    /**
     * The ID of the instance the volume is attached to.
     */
    const TYPE_ATTACHMENT_INSTANCE_ID = 'attachment.instance-id';

    /**
     * The attachment state.
     * Valid values: attaching | attached | detaching | detached
     */
    const TYPE_ATTACHMENT_STATUS = 'attachment.status';

    /**
     * The Availability Zone of the instance.
     */
    const TYPE_AVAILABILITY_ZONE = 'availability-zone';

    /**
     * The time stamp when the volume was created.
     * Type: DateTime
     */
    const TYPE_CREATE_TIME = 'create-time';

    /**
     * The size of the volume, in GiB (for example, 20).
     */
    const TYPE_SIZE = 'size';

    /**
     * The snapshot from which the volume was created.
     */
    const TYPE_SNAPSHOT_ID = 'snapshot-id';

    /**
     * The status of the volume.
     * Valid values: creating | available | in-use | deleting | deleted | error
     */
    const TYPE_STATUS = 'status';

    /**
     * The key of a tag assigned to the resource.
     * This filter is independent of the tag-value filter.
     * For example, if you use both the filter "tag-key=Purpose" and the filter "tag-value=X",
     * you get any resources assigned both the tag key Purpose (regardless of what the tag's value is),
     * and the tag value X (regardless of what the tag's key is). If you want to list only resources where
     * Purpose is X, see the tag:key filter
     */
    const TYPE_TAG_KEY = 'tag-key';

    /**
     * The value of a tag assigned to the resource. This filter is independent of the tag-key filter.
     */
    const TYPE_TAG_VALUE = 'tag-value';

    /**
     * The volume ID.
     */
    const TYPE_VOLUME_ID = 'volume-id';

    /**
     * The Amazon EBS volume type. If the volume is an io1 volume, the response includes the IOPS as well.
     * Valid values: standard | io1 | gp2
     */
    const TYPE_VOLUME_TYPE = 'volume-type';

    public static function getPrefix()
    {
        return 'TYPE_';
    }

    /**
     * {@inheritdoc}
     * @see Scalr\Service\Aws\DataType.StringType::validate()
     */
    protected function validate()
    {
        return preg_match('#^tag\:.+#', $this->value) ?: parent::validate();
    }

    /**
     * {@inheritdoc}
     * @see Scalr\Service\Aws\DataType.StringType::__callstatic()
     */
    public static function __callStatic($name, $args)
    {
        $class = __CLASS__;
        if ($name == 'tag') {
            if (!isset($args[0])) {
                throw new \InvalidArgumentException(sprintf(
                    'Tag name must be provided! Please use %s::tag("symbolic-name")', $class
                ));
            }
            return new $class('tag:' . $args[0]);
        }
        return parent::__callStatic($name, $args);
    }
}
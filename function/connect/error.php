<?php
class ErrorServer implements ArrayAccess
{
    const DATABASE_CONNECTION_EMPTY = 'Kết nối cơ sở dữ liệu không thành công, vui lòng không để trống các trường cấu hình.';
    const DATABASE_CONNECTION_ERROR = 'Không thể kết nối đến cơ sở dữ liệu: ';
    const DATABASE_QUERY_ERROR = 'Lỗi nghiêm trọng khi cố gắng truy vấn dữ liệu từ cơ sở dữ liệu.';
    const SERVER_UNSUPORTED = 'Mã nguồn này yêu cầu ít nhất phiên bản PHP 8.0 tối thiểu trở lên và bắt buộc phải hỗ trợ MySQLi Server, vui lòng kiểm tra xem hosting/server của bạn có đang hỗ trợ hay không và hãy cấu hình theo yêu cầu.';

    private $errors = [];

    public function __construct()
    {
        $this->errors = [
            0x000000 => self::DATABASE_CONNECTION_EMPTY,
            0x000001 => self::DATABASE_CONNECTION_ERROR . mysqli_connect_error(),
            0x000002 => self::DATABASE_QUERY_ERROR,
            0x000003 => self::SERVER_UNSUPORTED,
        ];
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->errors[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->errors[$offset] ?? 'Lỗi không xác định.';
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->errors[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->errors[$offset]);
    }
}

$x = new ErrorServer();

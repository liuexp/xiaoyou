#include <iostream>
#include <string>
#include <vector>
using namespace std;

int main() {
  string teacher_name, course_names;
  vector<string> teacher_names;
  int base = 10000, id = 0;
  while (cin >> teacher_name >> course_names) {
    teacher_names.push_back(teacher_name);
    cout << "insert into "
      << "articles(id,title,content,priority,type,visible,created_at) "
      << "values(" << (base + (++id)) << ", '" << teacher_name << "', '" << teacher_name << "老师讲授过的课程有：" << course_names << "。请评论本文，以提供该任课教师语录或您对该教师的评价。谢谢！', 7654321, 'post', 0, now());"
      << endl;
  }
  teacher_names.push_back("John Edward Hopcroft");
  cout << "insert into articles(id,title,content,priority,type,visible,created_at) values(" << (base + (++id)) << ", 'John Edward Hopcroft', 'John Edward Hopcroft讲授过的课程有：面向计算机科学的数学基础。请评论本文，以提供该任课教师语录或您对该教师的评价。谢谢！', 7654321, 'post', 0, now());" << endl;
  
  cout << endl;
  cout << "<table>" << endl;
  const int K = 5;
  bool first = true;
  for (int i = 0; i < teacher_names.size(); i++) {
    if (i % K == 0) {
      if (first) first = false;
      else cout << "</tr>" << endl;
      cout << "<tr>" << endl;
    }
    cout << "<td><a href=\"/article/" << (base + i + 1) << "\">" << teacher_names[i] << "</a></td>" << endl;
  }
  cout << "</tr>" << endl;
  cout << "</table>" << endl;
  return 0;
}
